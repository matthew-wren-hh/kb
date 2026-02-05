package com.cascade.plugin.imageoptimizer;

import net.coobird.thumbnailator.Thumbnails;
import org.imgscalr.Scalr;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * Core image processing pipeline: resize -> optimize -> format conversion.
 * Uses imgscalr for high-quality scaling and Thumbnailator for optimized encoding.
 */
public class ImageProcessor {

    private static final Logger LOGGER = Logger.getLogger(ImageProcessor.class.getName());

    private final ImageOptimizationConfig config;

    public ImageProcessor(ImageOptimizationConfig config) {
        this.config = config;
    }

    /**
     * Process an image according to the configuration.
     *
     * @param imageData        Original image bytes
     * @param originalFilename Original filename (used to detect format)
     * @return Processing result with optimized image and any additional sizes
     * @throws Exception if processing fails
     */
    public ProcessedImageResult process(byte[] imageData, String originalFilename) throws Exception {
        ProcessedImageResult result = new ProcessedImageResult();
        result.setOriginalSize(imageData.length);

        // Validate input size
        if (imageData.length > config.getMaxInputBytes()) {
            throw new IllegalArgumentException(String.format(
                    "Image file too large: %d bytes (max: %d bytes)",
                    imageData.length, config.getMaxInputBytes()));
        }

        // Read the original image
        BufferedImage originalImage = ImageIO.read(new ByteArrayInputStream(imageData));
        if (originalImage == null) {
            throw new IllegalArgumentException(
                    "Could not read image data. The file may be corrupted or in an unsupported format.");
        }

        // Validate dimensions
        long pixels = (long) originalImage.getWidth() * originalImage.getHeight();
        if (pixels > config.getMaxPixels()) {
            throw new IllegalArgumentException(String.format(
                    "Image dimensions too large: %dx%d (%d megapixels, max: %d megapixels)",
                    originalImage.getWidth(), originalImage.getHeight(),
                    pixels / 1_000_000, config.getMaxPixels() / 1_000_000));
        }

        LOGGER.fine(String.format("Processing image: %s (%dx%d, %d bytes)",
                originalFilename, originalImage.getWidth(), originalImage.getHeight(), imageData.length));

        // Detect original format
        String originalExtension = getExtension(originalFilename);

        // Step 1: Resize if needed
        BufferedImage resizedImage = resizeImage(originalImage);

        // Step 2: Optimize and convert to target format
        String outputExtension = config.getOutputExtension(originalExtension);
        byte[] optimizedData = encodeImage(resizedImage, outputExtension);

        result.setPrimaryImage(optimizedData);
        result.setPrimaryExtension(outputExtension);
        result.setPrimaryWidth(resizedImage.getWidth());
        result.setPrimaryHeight(resizedImage.getHeight());

        LOGGER.fine(String.format("Primary image processed: %dx%d, %s, %d bytes (%.1f%% reduction)",
                resizedImage.getWidth(), resizedImage.getHeight(), outputExtension,
                optimizedData.length, result.getSizeReductionPercent()));

        // Step 3: Generate additional sizes
        if (config.hasAdditionalSizes()) {
            for (ImageOptimizationConfig.SizeSpec size : config.getAdditionalSizes()) {
                try {
                    BufferedImage sizedImage = resizeToSpec(originalImage, size);
                    byte[] sizedData = encodeImage(sizedImage, outputExtension);

                    result.addAdditionalSize(size, sizedData,
                            sizedImage.getWidth(), sizedImage.getHeight(), outputExtension);

                    LOGGER.fine(String.format("Additional size generated: %s -> %dx%d, %d bytes",
                            size, sizedImage.getWidth(), sizedImage.getHeight(), sizedData.length));
                } catch (Exception e) {
                    LOGGER.log(Level.WARNING, "Failed to generate size: " + size, e);
                    // Continue with other sizes
                }
            }
        }

        return result;
    }

    /**
     * Resize image according to max width/height configuration.
     */
    private BufferedImage resizeImage(BufferedImage original) {
        Integer targetWidth = config.getMaxWidth();
        Integer targetHeight = config.getMaxHeight();

        if (targetWidth == null && targetHeight == null) {
            return original;
        }

        int originalWidth = original.getWidth();
        int originalHeight = original.getHeight();

        // Calculate target dimensions
        int[] newDimensions = calculateDimensions(
                originalWidth, originalHeight, targetWidth, targetHeight);

        int newWidth = newDimensions[0];
        int newHeight = newDimensions[1];

        // Only resize if dimensions changed
        if (newWidth == originalWidth && newHeight == originalHeight) {
            return original;
        }

        return doResize(original, newWidth, newHeight);
    }

    /**
     * Resize image to a specific size specification.
     */
    private BufferedImage resizeToSpec(BufferedImage original, ImageOptimizationConfig.SizeSpec size) {
        int originalWidth = original.getWidth();
        int originalHeight = original.getHeight();

        int[] newDimensions = calculateDimensions(
                originalWidth, originalHeight, size.getWidth(), size.getHeight());

        return doResize(original, newDimensions[0], newDimensions[1]);
    }

    /**
     * Calculate target dimensions while preserving aspect ratio if configured.
     */
    private int[] calculateDimensions(int originalWidth, int originalHeight,
                                       Integer targetWidth, Integer targetHeight) {
        if (targetWidth == null && targetHeight == null) {
            return new int[]{originalWidth, originalHeight};
        }

        int newWidth = originalWidth;
        int newHeight = originalHeight;

        if (config.isPreserveAspectRatio()) {
            double aspectRatio = (double) originalWidth / originalHeight;

            if (targetWidth != null && targetHeight != null) {
                // Fit within bounds
                if (originalWidth > targetWidth || originalHeight > targetHeight) {
                    double widthRatio = (double) targetWidth / originalWidth;
                    double heightRatio = (double) targetHeight / originalHeight;
                    double ratio = Math.min(widthRatio, heightRatio);
                    newWidth = (int) Math.round(originalWidth * ratio);
                    newHeight = (int) Math.round(originalHeight * ratio);
                }
            } else if (targetWidth != null) {
                if (originalWidth > targetWidth) {
                    newWidth = targetWidth;
                    newHeight = (int) Math.round(targetWidth / aspectRatio);
                }
            } else {
                if (originalHeight > targetHeight) {
                    newHeight = targetHeight;
                    newWidth = (int) Math.round(targetHeight * aspectRatio);
                }
            }
        } else {
            // Don't preserve aspect ratio
            newWidth = targetWidth != null ? targetWidth : originalWidth;
            newHeight = targetHeight != null ? targetHeight : originalHeight;
        }

        // Ensure minimum dimensions
        newWidth = Math.max(1, newWidth);
        newHeight = Math.max(1, newHeight);

        return new int[]{newWidth, newHeight};
    }

    /**
     * Perform the actual resize using imgscalr for high quality.
     */
    private BufferedImage doResize(BufferedImage original, int targetWidth, int targetHeight) {
        Scalr.Method method = mapScalingMethod(config.getScalingMethod());

        return Scalr.resize(original, method,
                Scalr.Mode.FIT_EXACT,
                targetWidth, targetHeight,
                Scalr.OP_ANTIALIAS);
    }

    /**
     * Encode image to the target format with optimization.
     */
    private byte[] encodeImage(BufferedImage image, String extension) throws Exception {
        switch (extension.toLowerCase()) {
            case "webp":
                return encodeWebP(image);
            case "jpg":
            case "jpeg":
                return encodeJpeg(image);
            case "png":
                return encodePng(image);
            case "gif":
                return encodeGif(image);
            default:
                // Default to JPEG for unknown formats
                return encodeJpeg(image);
        }
    }

    private byte[] encodeJpeg(BufferedImage image) throws Exception {
        // Ensure no alpha channel for JPEG
        BufferedImage rgbImage = ensureRGB(image);

        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        Thumbnails.of(rgbImage)
                .scale(1.0)
                .outputFormat("jpg")
                .outputQuality(config.getQuality())
                .toOutputStream(baos);
        return baos.toByteArray();
    }

    private byte[] encodePng(BufferedImage image) throws Exception {
        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        // PNG is lossless, Thumbnailator handles optimization
        Thumbnails.of(image)
                .scale(1.0)
                .outputFormat("png")
                .toOutputStream(baos);
        return baos.toByteArray();
    }

    private byte[] encodeGif(BufferedImage image) throws Exception {
        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        ImageIO.write(image, "gif", baos);
        return baos.toByteArray();
    }

    private byte[] encodeWebP(BufferedImage image) throws Exception {
        if (!WebPConverter.isAvailable()) {
            // Fall back to JPEG if WebP is not available
            LOGGER.warning("WebP not available, falling back to JPEG: " +
                    WebPConverter.getUnavailableReason());
            return encodeJpeg(image);
        }

        boolean lossless = config.getWebpCompressionType() ==
                ImageOptimizationConfig.WebPCompressionType.LOSSLESS;

        return WebPConverter.encode(image, config.getQuality(), lossless);
    }

    /**
     * Convert image to RGB (no alpha) for formats that don't support transparency.
     */
    private BufferedImage ensureRGB(BufferedImage image) {
        if (image.getType() == BufferedImage.TYPE_INT_RGB ||
                image.getType() == BufferedImage.TYPE_3BYTE_BGR) {
            return image;
        }

        BufferedImage rgbImage = new BufferedImage(
                image.getWidth(), image.getHeight(), BufferedImage.TYPE_INT_RGB);

        // Draw with white background for transparency
        java.awt.Graphics2D g = rgbImage.createGraphics();
        g.setColor(java.awt.Color.WHITE);
        g.fillRect(0, 0, image.getWidth(), image.getHeight());
        g.drawImage(image, 0, 0, null);
        g.dispose();

        return rgbImage;
    }

    /**
     * Map configuration scaling method to imgscalr method.
     */
    private Scalr.Method mapScalingMethod(ImageOptimizationConfig.ScalingMethod method) {
        switch (method) {
            case SPEED:
                return Scalr.Method.SPEED;
            case BALANCED:
                return Scalr.Method.BALANCED;
            case ULTRA_QUALITY:
                return Scalr.Method.ULTRA_QUALITY;
            case QUALITY:
            default:
                return Scalr.Method.QUALITY;
        }
    }

    /**
     * Extract file extension from filename.
     */
    private String getExtension(String filename) {
        if (filename == null) {
            return "jpg";
        }
        int lastDot = filename.lastIndexOf('.');
        if (lastDot > 0 && lastDot < filename.length() - 1) {
            return filename.substring(lastDot + 1).toLowerCase();
        }
        return "jpg";
    }
}
