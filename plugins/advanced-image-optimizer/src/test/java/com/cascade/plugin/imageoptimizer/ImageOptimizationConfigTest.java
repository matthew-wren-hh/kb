package com.cascade.plugin.imageoptimizer;

import org.junit.Test;
import static org.junit.Assert.*;

import java.util.List;

/**
 * Unit tests for ImageOptimizationConfig.
 */
public class ImageOptimizationConfigTest {

    @Test
    public void testSizeSpecParseSingleWidth() {
        ImageOptimizationConfig.SizeSpec spec = ImageOptimizationConfig.SizeSpec.parse("400");
        assertNotNull(spec);
        assertEquals(Integer.valueOf(400), spec.getWidth());
        assertNull(spec.getHeight());
    }

    @Test
    public void testSizeSpecParseWidthAndHeight() {
        ImageOptimizationConfig.SizeSpec spec = ImageOptimizationConfig.SizeSpec.parse("800x600");
        assertNotNull(spec);
        assertEquals(Integer.valueOf(800), spec.getWidth());
        assertEquals(Integer.valueOf(600), spec.getHeight());
    }

    @Test
    public void testSizeSpecParseHeightOnly() {
        ImageOptimizationConfig.SizeSpec spec = ImageOptimizationConfig.SizeSpec.parse("x300");
        assertNotNull(spec);
        assertNull(spec.getWidth());
        assertEquals(Integer.valueOf(300), spec.getHeight());
    }

    @Test
    public void testSizeSpecParseList() {
        List<ImageOptimizationConfig.SizeSpec> specs =
            ImageOptimizationConfig.SizeSpec.parseList("200x200, 400, 800x600");

        assertEquals(3, specs.size());

        assertEquals(Integer.valueOf(200), specs.get(0).getWidth());
        assertEquals(Integer.valueOf(200), specs.get(0).getHeight());

        assertEquals(Integer.valueOf(400), specs.get(1).getWidth());
        assertNull(specs.get(1).getHeight());

        assertEquals(Integer.valueOf(800), specs.get(2).getWidth());
        assertEquals(Integer.valueOf(600), specs.get(2).getHeight());
    }

    @Test
    public void testSizeSpecParseEmptyList() {
        List<ImageOptimizationConfig.SizeSpec> specs =
            ImageOptimizationConfig.SizeSpec.parseList("");
        assertTrue(specs.isEmpty());

        specs = ImageOptimizationConfig.SizeSpec.parseList(null);
        assertTrue(specs.isEmpty());
    }

    @Test
    public void testOutputFormatFromString() {
        assertEquals(ImageOptimizationConfig.OutputFormat.JPEG,
            ImageOptimizationConfig.OutputFormat.fromString("jpeg"));
        assertEquals(ImageOptimizationConfig.OutputFormat.JPEG,
            ImageOptimizationConfig.OutputFormat.fromString("JPEG"));
        assertEquals(ImageOptimizationConfig.OutputFormat.WEBP,
            ImageOptimizationConfig.OutputFormat.fromString("webp"));
        assertEquals(ImageOptimizationConfig.OutputFormat.ORIGINAL,
            ImageOptimizationConfig.OutputFormat.fromString(null));
        assertEquals(ImageOptimizationConfig.OutputFormat.ORIGINAL,
            ImageOptimizationConfig.OutputFormat.fromString("invalid"));
    }

    @Test
    public void testQualityBounds() {
        ImageOptimizationConfig config = new ImageOptimizationConfig();

        config.setQuality(0.5f);
        assertEquals(0.5f, config.getQuality(), 0.001);

        config.setQuality(-0.5f);
        assertEquals(0.0f, config.getQuality(), 0.001);

        config.setQuality(1.5f);
        assertEquals(1.0f, config.getQuality(), 0.001);
    }

    @Test
    public void testBuildSuffix() {
        ImageOptimizationConfig config = new ImageOptimizationConfig();
        config.setSizeSuffixPattern("-{w}x{h}");

        ImageOptimizationConfig.SizeSpec spec =
            new ImageOptimizationConfig.SizeSpec(400, 300);

        String suffix = config.buildSuffix(spec, 400, 300);
        assertEquals("-400x300", suffix);
    }

    @Test
    public void testOutputExtension() {
        ImageOptimizationConfig config = new ImageOptimizationConfig();

        config.setOutputFormat(ImageOptimizationConfig.OutputFormat.ORIGINAL);
        assertEquals("png", config.getOutputExtension("png"));
        assertEquals("jpg", config.getOutputExtension("jpg"));

        config.setOutputFormat(ImageOptimizationConfig.OutputFormat.WEBP);
        assertEquals("webp", config.getOutputExtension("png"));
        assertEquals("webp", config.getOutputExtension("jpg"));

        config.setOutputFormat(ImageOptimizationConfig.OutputFormat.JPEG);
        assertEquals("jpg", config.getOutputExtension("png"));
    }

    @Test
    public void testDefaultValues() {
        ImageOptimizationConfig config = new ImageOptimizationConfig();

        assertEquals(ImageOptimizationConfig.OutputFormat.ORIGINAL, config.getOutputFormat());
        assertEquals(0.8f, config.getQuality(), 0.001);
        assertNull(config.getMaxWidth());
        assertNull(config.getMaxHeight());
        assertTrue(config.isStripMetadata());
        assertTrue(config.isPreserveAspectRatio());
        assertEquals(ImageOptimizationConfig.ScalingMethod.QUALITY, config.getScalingMethod());
        assertEquals(ImageOptimizationConfig.WebPCompressionType.LOSSY, config.getWebpCompressionType());
    }
}
