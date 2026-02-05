package com.cascade.plugin.imageoptimizer;

import javax.imageio.IIOImage;
import javax.imageio.ImageIO;
import javax.imageio.ImageWriteParam;
import javax.imageio.ImageWriter;
import javax.imageio.stream.ImageOutputStream;
import java.awt.image.BufferedImage;
import java.io.ByteArrayOutputStream;
import java.util.Iterator;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 * WebP encoding wrapper with availability detection and graceful fallback.
 * Uses sejda webp-imageio library which bundles native libraries.
 */
public class WebPConverter {

    private static final Logger LOGGER = Logger.getLogger(WebPConverter.class.getName());

    private static Boolean webpAvailable = null;
    private static String unavailableReason = null;

    /**
     * Check if WebP encoding is available in the current environment.
     * Caches the result after first check.
     */
    public static synchronized boolean isAvailable() {
        if (webpAvailable == null) {
            webpAvailable = checkWebPAvailability();
        }
        return webpAvailable;
    }

    /**
     * Get the reason WebP is unavailable, if applicable.
     */
    public static String getUnavailableReason() {
        isAvailable(); // Ensure check has been performed
        return unavailableReason;
    }

    private static boolean checkWebPAvailability() {
        try {
            Iterator<ImageWriter> writers = ImageIO.getImageWritersByMIMEType("image/webp");
            if (!writers.hasNext()) {
                unavailableReason = "No WebP ImageWriter found. The webp-imageio library may not be installed.";
                LOGGER.info("WebP encoding not available: " + unavailableReason);
                return false;
            }

            // Try to get the writer to ensure native libs load
            ImageWriter writer = writers.next();
            writer.dispose();

            LOGGER.info("WebP encoding is available");
            return true;

        } catch (UnsatisfiedLinkError e) {
            unavailableReason = "Native WebP library could not be loaded: " + e.getMessage();
            LOGGER.log(Level.WARNING, "WebP native library unavailable", e);
            return false;
        } catch (NoClassDefFoundError e) {
            unavailableReason = "WebP library classes not found: " + e.getMessage();
            LOGGER.log(Level.WARNING, "WebP classes unavailable", e);
            return false;
        } catch (Exception e) {
            unavailableReason = "Unexpected error checking WebP availability: " + e.getMessage();
            LOGGER.log(Level.WARNING, "WebP availability check failed", e);
            return false;
        }
    }

    /**
     * Encode a BufferedImage to WebP format.
     *
     * @param image       The image to encode
     * @param quality     Compression quality (0.0 to 1.0), used for lossy compression
     * @param lossless    If true, use lossless compression (quality parameter ignored)
     * @return Encoded WebP bytes
     * @throws UnsupportedOperationException if WebP encoding is not available
     * @throws Exception                     if encoding fails
     */
    public static byte[] encode(BufferedImage image, float quality, boolean lossless) throws Exception {
        if (!isAvailable()) {
            throw new UnsupportedOperationException(
                    "WebP encoding is not available: " + getUnavailableReason());
        }

        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        ImageOutputStream ios = null;
        ImageWriter writer = null;

        try {
            Iterator<ImageWriter> writers = ImageIO.getImageWritersByMIMEType("image/webp");
            if (!writers.hasNext()) {
                throw new IllegalStateException("WebP writer not found after availability check");
            }

            writer = writers.next();
            ios = ImageIO.createImageOutputStream(baos);
            writer.setOutput(ios);

            ImageWriteParam writeParam = writer.getDefaultWriteParam();

            if (writeParam.canWriteCompressed()) {
                writeParam.setCompressionMode(ImageWriteParam.MODE_EXPLICIT);

                String[] compressionTypes = writeParam.getCompressionTypes();
                if (compressionTypes != null && compressionTypes.length > 0) {
                    if (lossless) {
                        // Find lossless compression type
                        boolean foundLossless = false;
                        for (String type : compressionTypes) {
                            if (type.toLowerCase().contains("lossless")) {
                                writeParam.setCompressionType(type);
                                foundLossless = true;
                                break;
                            }
                        }
                        if (!foundLossless) {
                            // Use first available type with high quality
                            writeParam.setCompressionType(compressionTypes[0]);
                            writeParam.setCompressionQuality(1.0f);
                            LOGGER.fine("Lossless WebP type not found, using high quality lossy");
                        }
                    } else {
                        // Lossy compression with specified quality
                        // Find lossy type or use first available
                        boolean foundLossy = false;
                        for (String type : compressionTypes) {
                            if (type.toLowerCase().contains("lossy") ||
                                    type.equalsIgnoreCase("default")) {
                                writeParam.setCompressionType(type);
                                foundLossy = true;
                                break;
                            }
                        }
                        if (!foundLossy) {
                            writeParam.setCompressionType(compressionTypes[0]);
                        }
                        writeParam.setCompressionQuality(quality);
                    }
                }
            }

            // Handle images with alpha channel
            BufferedImage imageToWrite = ensureCompatibleColorModel(image);

            writer.write(null, new IIOImage(imageToWrite, null, null), writeParam);

            ios.flush();
            return baos.toByteArray();

        } finally {
            if (writer != null) {
                writer.dispose();
            }
            if (ios != null) {
                try {
                    ios.close();
                } catch (Exception ignored) {
                }
            }
        }
    }

    /**
     * Encode with default lossy compression at the specified quality.
     */
    public static byte[] encode(BufferedImage image, float quality) throws Exception {
        return encode(image, quality, false);
    }

    /**
     * Encode with lossless compression.
     */
    public static byte[] encodeLossless(BufferedImage image) throws Exception {
        return encode(image, 1.0f, true);
    }

    /**
     * Ensure the image has a color model compatible with WebP encoding.
     * WebP supports ARGB, so we may need to convert indexed or other formats.
     */
    private static BufferedImage ensureCompatibleColorModel(BufferedImage image) {
        int type = image.getType();

        // These types should work directly
        if (type == BufferedImage.TYPE_INT_ARGB ||
                type == BufferedImage.TYPE_INT_RGB ||
                type == BufferedImage.TYPE_3BYTE_BGR ||
                type == BufferedImage.TYPE_4BYTE_ABGR) {
            return image;
        }

        // Convert to ARGB for maximum compatibility
        boolean hasAlpha = image.getColorModel().hasAlpha();
        int targetType = hasAlpha ? BufferedImage.TYPE_INT_ARGB : BufferedImage.TYPE_INT_RGB;

        BufferedImage converted = new BufferedImage(
                image.getWidth(), image.getHeight(), targetType);
        converted.createGraphics().drawImage(image, 0, 0, null);

        return converted;
    }

    /**
     * Reset the availability cache, useful for testing or after configuration changes.
     */
    public static synchronized void resetAvailabilityCache() {
        webpAvailable = null;
        unavailableReason = null;
    }
}
