package com.cascade.plugin.imageoptimizer;

import java.util.LinkedHashMap;
import java.util.Map;

/**
 * Holds the results of image processing including the primary optimized image
 * and any additional size variants.
 */
public class ProcessedImageResult {

    private byte[] primaryImage;
    private String primaryExtension;
    private int primaryWidth;
    private int primaryHeight;
    private long originalSize;
    private long optimizedSize;

    private final Map<ImageOptimizationConfig.SizeSpec, SizedImage> additionalSizes = new LinkedHashMap<>();

    /**
     * Represents a sized variant of the image.
     */
    public static class SizedImage {
        private final byte[] data;
        private final int width;
        private final int height;
        private final String extension;

        public SizedImage(byte[] data, int width, int height, String extension) {
            this.data = data;
            this.width = width;
            this.height = height;
            this.extension = extension;
        }

        public byte[] getData() {
            return data;
        }

        public int getWidth() {
            return width;
        }

        public int getHeight() {
            return height;
        }

        public String getExtension() {
            return extension;
        }

        public long getSize() {
            return data != null ? data.length : 0;
        }
    }

    public ProcessedImageResult() {
    }

    public byte[] getPrimaryImage() {
        return primaryImage;
    }

    public void setPrimaryImage(byte[] primaryImage) {
        this.primaryImage = primaryImage;
        this.optimizedSize = primaryImage != null ? primaryImage.length : 0;
    }

    public String getPrimaryExtension() {
        return primaryExtension;
    }

    public void setPrimaryExtension(String primaryExtension) {
        this.primaryExtension = primaryExtension;
    }

    public int getPrimaryWidth() {
        return primaryWidth;
    }

    public void setPrimaryWidth(int primaryWidth) {
        this.primaryWidth = primaryWidth;
    }

    public int getPrimaryHeight() {
        return primaryHeight;
    }

    public void setPrimaryHeight(int primaryHeight) {
        this.primaryHeight = primaryHeight;
    }

    public long getOriginalSize() {
        return originalSize;
    }

    public void setOriginalSize(long originalSize) {
        this.originalSize = originalSize;
    }

    public long getOptimizedSize() {
        return optimizedSize;
    }

    public Map<ImageOptimizationConfig.SizeSpec, SizedImage> getAdditionalSizes() {
        return additionalSizes;
    }

    public void addAdditionalSize(ImageOptimizationConfig.SizeSpec spec, byte[] data,
                                   int width, int height, String extension) {
        additionalSizes.put(spec, new SizedImage(data, width, height, extension));
    }

    public boolean hasAdditionalSizes() {
        return !additionalSizes.isEmpty();
    }

    /**
     * Calculate compression ratio (original size / optimized size).
     */
    public double getCompressionRatio() {
        if (optimizedSize == 0) return 0;
        return (double) originalSize / optimizedSize;
    }

    /**
     * Calculate size reduction percentage.
     */
    public double getSizeReductionPercent() {
        if (originalSize == 0) return 0;
        return 100.0 * (1.0 - ((double) optimizedSize / originalSize));
    }

    @Override
    public String toString() {
        return String.format("ProcessedImageResult{%dx%d, %s, %d bytes -> %d bytes (%.1f%% reduction), %d variants}",
                primaryWidth, primaryHeight, primaryExtension,
                originalSize, optimizedSize, getSizeReductionPercent(),
                additionalSizes.size());
    }
}
