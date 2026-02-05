package com.cascade.plugin.imageoptimizer;

import com.cms.assetfactory.BaseAssetFactoryPlugin;
import com.cms.assetfactory.FatalPluginException;
import com.cms.assetfactory.PluginException;
import com.hannonhill.cascade.api.asset.admin.AssetFactory;
import com.hannonhill.cascade.api.asset.home.File;
import com.hannonhill.cascade.api.asset.home.Folder;
import com.hannonhill.cascade.api.asset.home.FolderContainedAsset;

import java.util.HashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Advanced Image Optimizer Plugin for Cascade CMS.
 *
 * Provides high-quality image optimization with:
 * - WebP output format support
 * - Configurable compression quality
 * - Multiple output sizes from single upload
 * - High-quality scaling algorithms
 * - Metadata stripping
 *
 * Uses pure Java libraries (Thumbnailator, imgscalr, webp-imageio) for
 * compatibility with hosted Cascade environments.
 */
public class AdvancedImageOptimizerPlugin extends BaseAssetFactoryPlugin {

    private static final Logger LOGGER = Logger.getLogger(AdvancedImageOptimizerPlugin.class.getName());

    // Parameter keys
    public static final String PARAM_OUTPUT_FORMAT = "outputFormat";
    public static final String PARAM_QUALITY = "quality";
    public static final String PARAM_MAX_WIDTH = "maxWidth";
    public static final String PARAM_MAX_HEIGHT = "maxHeight";
    public static final String PARAM_STRIP_METADATA = "stripMetadata";
    public static final String PARAM_ADDITIONAL_SIZES = "additionalSizes";
    public static final String PARAM_SIZE_SUFFIX_PATTERN = "sizeSuffixPattern";
    public static final String PARAM_WEBP_COMPRESSION_TYPE = "webpCompressionType";
    public static final String PARAM_PRESERVE_ASPECT_RATIO = "preserveAspectRatio";
    public static final String PARAM_SCALING_METHOD = "scalingMethod";

    // Supported image extensions
    private static final String[] SUPPORTED_EXTENSIONS = {
            ".jpg", ".jpeg", ".png", ".gif", ".bmp", ".webp"
    };

    @Override
    public void doPluginActionPre(AssetFactory factory, FolderContainedAsset asset)
            throws PluginException {
        // Pre-action validation - runs before user edits
        // We could validate file type here, but we'll be permissive
        // and just skip non-image files in doPluginActionPost
    }

    @Override
    public void doPluginActionPost(AssetFactory factory, FolderContainedAsset asset)
            throws PluginException {

        // Only process File assets
        if (!(asset instanceof File)) {
            return;
        }

        File file = (File) asset;
        String filename = file.getName();

        // Skip non-image files
        if (!isImageFile(filename)) {
            LOGGER.fine("Skipping non-image file: " + filename);
            return;
        }

        try {
            // Build configuration from plugin parameters
            ImageOptimizationConfig config = buildConfig(factory);
            LOGGER.fine("Processing with config: " + config);

            // Get original image data
            byte[] originalData = file.getData();
            if (originalData == null || originalData.length == 0) {
                LOGGER.warning("No image data in file: " + filename);
                return;
            }

            // Process the image
            ImageProcessor processor = new ImageProcessor(config);
            ProcessedImageResult result = processor.process(originalData, filename);

            // Update the main asset with optimized image
            file.setData(result.getPrimaryImage());

            // Update filename if format changed
            String newExtension = result.getPrimaryExtension();
            String currentExtension = getExtension(filename);
            if (!newExtension.equalsIgnoreCase(currentExtension)) {
                String newFilename = replaceExtension(filename, newExtension);
                file.setName(newFilename);
                LOGGER.info(String.format("Renamed %s to %s", filename, newFilename));
            }

            LOGGER.info(String.format("Optimized %s: %d bytes -> %d bytes (%.1f%% reduction)",
                    filename, result.getOriginalSize(), result.getOptimizedSize(),
                    result.getSizeReductionPercent()));

            // Create additional size variants
            if (result.hasAdditionalSizes()) {
                createAdditionalSizeAssets(factory, file, result, config);
            }

        } catch (IllegalArgumentException e) {
            // Input validation errors - fatal, provide user-friendly message
            throw new FatalPluginException(getUserFriendlyMessage(e), e);
        } catch (OutOfMemoryError e) {
            throw new FatalPluginException(
                    "Insufficient memory to process image. Please upload a smaller file.", e);
        } catch (Exception e) {
            LOGGER.log(Level.SEVERE, "Image optimization failed for: " + filename, e);
            throw new FatalPluginException("Image optimization failed: " + e.getMessage(), e);
        }
    }

    /**
     * Build configuration from Asset Factory plugin parameters.
     */
    private ImageOptimizationConfig buildConfig(AssetFactory factory) {
        ImageOptimizationConfig config = new ImageOptimizationConfig();

        config.setOutputFormat(getParameter(factory, PARAM_OUTPUT_FORMAT));
        config.setQuality(getParameter(factory, PARAM_QUALITY));
        config.setMaxWidth(getParameter(factory, PARAM_MAX_WIDTH));
        config.setMaxHeight(getParameter(factory, PARAM_MAX_HEIGHT));
        config.setStripMetadata(getParameter(factory, PARAM_STRIP_METADATA));
        config.setAdditionalSizes(getParameter(factory, PARAM_ADDITIONAL_SIZES));
        config.setSizeSuffixPattern(getParameter(factory, PARAM_SIZE_SUFFIX_PATTERN));
        config.setWebpCompressionType(getParameter(factory, PARAM_WEBP_COMPRESSION_TYPE));
        config.setPreserveAspectRatio(getParameter(factory, PARAM_PRESERVE_ASPECT_RATIO));
        config.setScalingMethod(getParameter(factory, PARAM_SCALING_METHOD));

        return config;
    }

    /**
     * Get a plugin parameter value.
     */
    private String getParameter(AssetFactory factory, String paramName) {
        try {
            Map<String, String> params = factory.getPluginParameters(getName());
            if (params != null) {
                return params.get(paramName);
            }
        } catch (Exception e) {
            LOGGER.fine("Could not get parameter " + paramName + ": " + e.getMessage());
        }
        return null;
    }

    /**
     * Create additional file assets for each configured size variant.
     */
    private void createAdditionalSizeAssets(AssetFactory factory, File originalFile,
                                             ProcessedImageResult result,
                                             ImageOptimizationConfig config) {
        String baseName = getBaseName(originalFile.getName());
        Folder parentFolder = originalFile.getParentFolder();

        for (Map.Entry<ImageOptimizationConfig.SizeSpec, ProcessedImageResult.SizedImage> entry :
                result.getAdditionalSizes().entrySet()) {

            ImageOptimizationConfig.SizeSpec spec = entry.getKey();
            ProcessedImageResult.SizedImage sizedImage = entry.getValue();

            try {
                // Build filename with size suffix
                String suffix = config.buildSuffix(spec, sizedImage.getWidth(), sizedImage.getHeight());
                String newFilename = baseName + suffix + "." + sizedImage.getExtension();

                // Create new file asset
                // Note: The actual creation method depends on Cascade API version
                // This is a simplified example - actual implementation may vary
                File newFile = createSiblingFile(parentFolder, newFilename, sizedImage.getData());

                if (newFile != null) {
                    LOGGER.info(String.format("Created size variant: %s (%dx%d, %d bytes)",
                            newFilename, sizedImage.getWidth(), sizedImage.getHeight(),
                            sizedImage.getSize()));
                }

            } catch (Exception e) {
                LOGGER.log(Level.WARNING,
                        "Failed to create size variant for spec " + spec, e);
                // Continue with other sizes
            }
        }
    }

    /**
     * Create a sibling file in the same folder.
     * Note: Implementation depends on Cascade API capabilities and version.
     */
    private File createSiblingFile(Folder folder, String filename, byte[] data) {
        try {
            // This is a placeholder - actual implementation depends on
            // available Cascade API methods for programmatic file creation.
            //
            // Options:
            // 1. Use Cascade's internal API if available
            // 2. Queue for creation via a separate service
            // 3. Store metadata for post-processing
            //
            // For now, we'll log a message. The actual implementation
            // should use the appropriate Cascade API calls.

            LOGGER.info("Would create sibling file: " + filename + " in folder: " +
                    (folder != null ? folder.getPath() : "unknown"));

            // TODO: Implement actual file creation using Cascade API
            // Example (API-dependent):
            // File newFile = new File();
            // newFile.setName(filename);
            // newFile.setData(data);
            // newFile.setParentFolder(folder);
            // assetService.create(newFile);

            return null;

        } catch (Exception e) {
            LOGGER.log(Level.WARNING, "Failed to create sibling file: " + filename, e);
            return null;
        }
    }

    /**
     * Check if a filename represents a supported image file.
     */
    private boolean isImageFile(String filename) {
        if (filename == null) {
            return false;
        }
        String lower = filename.toLowerCase();
        for (String ext : SUPPORTED_EXTENSIONS) {
            if (lower.endsWith(ext)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get file extension from filename.
     */
    private String getExtension(String filename) {
        int lastDot = filename.lastIndexOf('.');
        if (lastDot > 0 && lastDot < filename.length() - 1) {
            return filename.substring(lastDot + 1).toLowerCase();
        }
        return "";
    }

    /**
     * Get base filename without extension.
     */
    private String getBaseName(String filename) {
        int lastDot = filename.lastIndexOf('.');
        return lastDot > 0 ? filename.substring(0, lastDot) : filename;
    }

    /**
     * Replace the file extension.
     */
    private String replaceExtension(String filename, String newExtension) {
        String baseName = getBaseName(filename);
        return baseName + "." + newExtension;
    }

    /**
     * Convert exceptions to user-friendly messages.
     */
    private String getUserFriendlyMessage(Exception e) {
        String message = e.getMessage();
        if (message == null) {
            return "An error occurred while processing the image.";
        }

        if (message.contains("Could not read image")) {
            return "The uploaded file does not appear to be a valid image. " +
                    "Please upload a JPEG, PNG, GIF, or WebP file.";
        }

        if (message.contains("too large")) {
            return message; // Already user-friendly
        }

        if (message.contains("WebP")) {
            return "WebP format is not available on this server. " +
                    "Please choose a different output format (JPEG or PNG).";
        }

        return "Image processing error: " + message;
    }

    // ========== Plugin Metadata Methods ==========

    @Override
    public String getName() {
        return "plugin.name";
    }

    @Override
    public String getDescription() {
        return "plugin.description";
    }

    @Override
    public String[] getAvailableParameterNames() {
        return new String[]{
                PARAM_OUTPUT_FORMAT,
                PARAM_QUALITY,
                PARAM_MAX_WIDTH,
                PARAM_MAX_HEIGHT,
                PARAM_STRIP_METADATA,
                PARAM_ADDITIONAL_SIZES,
                PARAM_SIZE_SUFFIX_PATTERN,
                PARAM_WEBP_COMPRESSION_TYPE,
                PARAM_PRESERVE_ASPECT_RATIO,
                PARAM_SCALING_METHOD
        };
    }

    @Override
    public Map<String, String> getAvailableParameterDescriptions() {
        Map<String, String> descriptions = new HashMap<>();

        descriptions.put(PARAM_OUTPUT_FORMAT,
                "Output format: original (keep same), jpeg, png, or webp. " +
                        "WebP typically provides 25-35% smaller files than JPEG at equivalent quality.");

        descriptions.put(PARAM_QUALITY,
                "Compression quality from 0.0 (smallest file, lowest quality) to 1.0 (largest file, best quality). " +
                        "Default: 0.8. Recommended: 0.75-0.85 for web images.");

        descriptions.put(PARAM_MAX_WIDTH,
                "Maximum width in pixels. Images wider than this will be scaled down. " +
                        "Leave blank to keep original width.");

        descriptions.put(PARAM_MAX_HEIGHT,
                "Maximum height in pixels. Images taller than this will be scaled down. " +
                        "Leave blank to keep original height.");

        descriptions.put(PARAM_STRIP_METADATA,
                "Remove EXIF, IPTC, and XMP metadata from images (true/false). " +
                        "Default: true. Reduces file size and removes potentially sensitive location data.");

        descriptions.put(PARAM_ADDITIONAL_SIZES,
                "Additional sizes to create, comma-separated. " +
                        "Format: WIDTHxHEIGHT or WIDTH (e.g., '200x200, 400, 800x600'). " +
                        "Creates separate files with size suffix.");

        descriptions.put(PARAM_SIZE_SUFFIX_PATTERN,
                "Filename suffix pattern for additional sizes. " +
                        "Use {w} for width, {h} for height. Default: '-{w}x{h}'. " +
                        "Example: photo.jpg with 200x200 becomes photo-200x200.jpg");

        descriptions.put(PARAM_WEBP_COMPRESSION_TYPE,
                "WebP compression type: 'lossy' (smaller files) or 'lossless' (perfect quality). " +
                        "Default: lossy. Lossless is best for graphics, lossy for photos.");

        descriptions.put(PARAM_PRESERVE_ASPECT_RATIO,
                "Maintain original aspect ratio when resizing (true/false). " +
                        "Default: true. If false, image may be stretched.");

        descriptions.put(PARAM_SCALING_METHOD,
                "Scaling quality vs speed: 'speed' (fastest), 'balanced', 'quality' (recommended), " +
                        "or 'ultra_quality' (best but slowest). Default: quality.");

        return descriptions;
    }
}
