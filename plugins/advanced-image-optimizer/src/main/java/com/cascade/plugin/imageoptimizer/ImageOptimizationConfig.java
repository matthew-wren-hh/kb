package com.cascade.plugin.imageoptimizer;

import java.util.ArrayList;
import java.util.List;

/**
 * Configuration POJO for image optimization settings.
 * Built from Asset Factory plugin parameters.
 */
public class ImageOptimizationConfig {

    public enum OutputFormat {
        ORIGINAL,
        JPEG,
        PNG,
        WEBP;

        public static OutputFormat fromString(String value) {
            if (value == null || value.isEmpty()) {
                return ORIGINAL;
            }
            try {
                return valueOf(value.toUpperCase());
            } catch (IllegalArgumentException e) {
                return ORIGINAL;
            }
        }
    }

    public enum ScalingMethod {
        SPEED,
        BALANCED,
        QUALITY,
        ULTRA_QUALITY;

        public static ScalingMethod fromString(String value) {
            if (value == null || value.isEmpty()) {
                return QUALITY;
            }
            try {
                return valueOf(value.toUpperCase());
            } catch (IllegalArgumentException e) {
                return QUALITY;
            }
        }
    }

    public enum WebPCompressionType {
        LOSSY,
        LOSSLESS;

        public static WebPCompressionType fromString(String value) {
            if (value == null || value.isEmpty()) {
                return LOSSY;
            }
            try {
                return valueOf(value.toUpperCase());
            } catch (IllegalArgumentException e) {
                return LOSSY;
            }
        }
    }

    /**
     * Represents a target image size specification.
     */
    public static class SizeSpec {
        private final Integer width;
        private final Integer height;

        public SizeSpec(Integer width, Integer height) {
            this.width = width;
            this.height = height;
        }

        /**
         * Parse size specification string.
         * Formats: "200x200", "400" (width only), "x300" (height only), "800x600"
         */
        public static SizeSpec parse(String spec) {
            if (spec == null || spec.trim().isEmpty()) {
                return null;
            }

            spec = spec.trim().toLowerCase();

            if (spec.contains("x")) {
                String[] parts = spec.split("x", 2);
                Integer w = parts[0].isEmpty() ? null : Integer.parseInt(parts[0]);
                Integer h = parts.length > 1 && !parts[1].isEmpty() ?
                        Integer.parseInt(parts[1]) : null;
                return new SizeSpec(w, h);
            } else {
                return new SizeSpec(Integer.parseInt(spec), null);
            }
        }

        /**
         * Parse comma-separated list of size specifications.
         */
        public static List<SizeSpec> parseList(String specs) {
            List<SizeSpec> result = new ArrayList<>();
            if (specs == null || specs.trim().isEmpty()) {
                return result;
            }

            for (String spec : specs.split(",")) {
                SizeSpec parsed = parse(spec);
                if (parsed != null) {
                    result.add(parsed);
                }
            }
            return result;
        }

        public Integer getWidth() {
            return width;
        }

        public Integer getHeight() {
            return height;
        }

        public boolean hasWidth() {
            return width != null;
        }

        public boolean hasHeight() {
            return height != null;
        }

        @Override
        public String toString() {
            if (width != null && height != null) {
                return width + "x" + height;
            } else if (width != null) {
                return width + "w";
            } else if (height != null) {
                return height + "h";
            }
            return "auto";
        }
    }

    // Configuration fields with defaults
    private OutputFormat outputFormat = OutputFormat.ORIGINAL;
    private float quality = 0.8f;
    private Integer maxWidth;
    private Integer maxHeight;
    private boolean stripMetadata = true;
    private List<SizeSpec> additionalSizes = new ArrayList<>();
    private String sizeSuffixPattern = "-{w}x{h}";
    private WebPCompressionType webpCompressionType = WebPCompressionType.LOSSY;
    private boolean preserveAspectRatio = true;
    private ScalingMethod scalingMethod = ScalingMethod.QUALITY;
    private boolean allowPassthrough = true;

    // Memory limits for safety
    private static final long DEFAULT_MAX_INPUT_BYTES = 50 * 1024 * 1024; // 50MB
    private static final long DEFAULT_MAX_PIXELS = 100_000_000; // 100 megapixels

    private long maxInputBytes = DEFAULT_MAX_INPUT_BYTES;
    private long maxPixels = DEFAULT_MAX_PIXELS;

    public ImageOptimizationConfig() {
    }

    // Getters and setters

    public OutputFormat getOutputFormat() {
        return outputFormat;
    }

    public void setOutputFormat(OutputFormat outputFormat) {
        this.outputFormat = outputFormat;
    }

    public void setOutputFormat(String outputFormat) {
        this.outputFormat = OutputFormat.fromString(outputFormat);
    }

    public float getQuality() {
        return quality;
    }

    public void setQuality(float quality) {
        this.quality = Math.max(0.0f, Math.min(1.0f, quality));
    }

    public void setQuality(String quality) {
        if (quality != null && !quality.isEmpty()) {
            try {
                setQuality(Float.parseFloat(quality));
            } catch (NumberFormatException e) {
                // Keep default
            }
        }
    }

    public Integer getMaxWidth() {
        return maxWidth;
    }

    public void setMaxWidth(Integer maxWidth) {
        this.maxWidth = maxWidth;
    }

    public void setMaxWidth(String maxWidth) {
        if (maxWidth != null && !maxWidth.isEmpty()) {
            try {
                this.maxWidth = Integer.parseInt(maxWidth);
            } catch (NumberFormatException e) {
                // Keep null
            }
        }
    }

    public Integer getMaxHeight() {
        return maxHeight;
    }

    public void setMaxHeight(Integer maxHeight) {
        this.maxHeight = maxHeight;
    }

    public void setMaxHeight(String maxHeight) {
        if (maxHeight != null && !maxHeight.isEmpty()) {
            try {
                this.maxHeight = Integer.parseInt(maxHeight);
            } catch (NumberFormatException e) {
                // Keep null
            }
        }
    }

    public boolean isStripMetadata() {
        return stripMetadata;
    }

    public void setStripMetadata(boolean stripMetadata) {
        this.stripMetadata = stripMetadata;
    }

    public void setStripMetadata(String stripMetadata) {
        if (stripMetadata != null && !stripMetadata.isEmpty()) {
            this.stripMetadata = Boolean.parseBoolean(stripMetadata);
        }
    }

    public List<SizeSpec> getAdditionalSizes() {
        return additionalSizes;
    }

    public void setAdditionalSizes(List<SizeSpec> additionalSizes) {
        this.additionalSizes = additionalSizes != null ? additionalSizes : new ArrayList<>();
    }

    public void setAdditionalSizes(String additionalSizes) {
        this.additionalSizes = SizeSpec.parseList(additionalSizes);
    }

    public boolean hasAdditionalSizes() {
        return !additionalSizes.isEmpty();
    }

    public String getSizeSuffixPattern() {
        return sizeSuffixPattern;
    }

    public void setSizeSuffixPattern(String sizeSuffixPattern) {
        if (sizeSuffixPattern != null && !sizeSuffixPattern.isEmpty()) {
            this.sizeSuffixPattern = sizeSuffixPattern;
        }
    }

    public WebPCompressionType getWebpCompressionType() {
        return webpCompressionType;
    }

    public void setWebpCompressionType(WebPCompressionType webpCompressionType) {
        this.webpCompressionType = webpCompressionType;
    }

    public void setWebpCompressionType(String webpCompressionType) {
        this.webpCompressionType = WebPCompressionType.fromString(webpCompressionType);
    }

    public boolean isPreserveAspectRatio() {
        return preserveAspectRatio;
    }

    public void setPreserveAspectRatio(boolean preserveAspectRatio) {
        this.preserveAspectRatio = preserveAspectRatio;
    }

    public void setPreserveAspectRatio(String preserveAspectRatio) {
        if (preserveAspectRatio != null && !preserveAspectRatio.isEmpty()) {
            this.preserveAspectRatio = Boolean.parseBoolean(preserveAspectRatio);
        }
    }

    public ScalingMethod getScalingMethod() {
        return scalingMethod;
    }

    public void setScalingMethod(ScalingMethod scalingMethod) {
        this.scalingMethod = scalingMethod;
    }

    public void setScalingMethod(String scalingMethod) {
        this.scalingMethod = ScalingMethod.fromString(scalingMethod);
    }

    public boolean isAllowPassthrough() {
        return allowPassthrough;
    }

    public void setAllowPassthrough(boolean allowPassthrough) {
        this.allowPassthrough = allowPassthrough;
    }

    public long getMaxInputBytes() {
        return maxInputBytes;
    }

    public void setMaxInputBytes(long maxInputBytes) {
        this.maxInputBytes = maxInputBytes;
    }

    public long getMaxPixels() {
        return maxPixels;
    }

    public void setMaxPixels(long maxPixels) {
        this.maxPixels = maxPixels;
    }

    /**
     * Build a suffix string for a given size specification.
     */
    public String buildSuffix(SizeSpec size, int actualWidth, int actualHeight) {
        String suffix = sizeSuffixPattern;
        suffix = suffix.replace("{w}", String.valueOf(actualWidth));
        suffix = suffix.replace("{h}", String.valueOf(actualHeight));
        return suffix;
    }

    /**
     * Get the file extension for the configured output format.
     */
    public String getOutputExtension(String originalExtension) {
        switch (outputFormat) {
            case JPEG:
                return "jpg";
            case PNG:
                return "png";
            case WEBP:
                return "webp";
            case ORIGINAL:
            default:
                return originalExtension;
        }
    }

    @Override
    public String toString() {
        return "ImageOptimizationConfig{" +
                "outputFormat=" + outputFormat +
                ", quality=" + quality +
                ", maxWidth=" + maxWidth +
                ", maxHeight=" + maxHeight +
                ", stripMetadata=" + stripMetadata +
                ", additionalSizes=" + additionalSizes +
                ", scalingMethod=" + scalingMethod +
                '}';
    }
}
