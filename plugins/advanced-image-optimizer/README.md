# Advanced Image Optimizer Plugin for Cascade CMS

A high-quality image optimization Asset Factory plugin for Cascade CMS that provides modern format support (WebP), configurable compression, and automatic generation of multiple image sizes.

## Features

- **WebP Output Support** - Convert images to WebP for 25-35% smaller files than JPEG
- **High-Quality Resizing** - Uses progressive bilinear scaling (imgscalr) for sharp results
- **Configurable Compression** - Fine-tune quality/size tradeoff for your needs
- **Multiple Output Sizes** - Generate responsive image variants from a single upload
- **Metadata Stripping** - Remove EXIF data to reduce file size and protect privacy
- **Pure Java** - No native dependencies required, works on hosted Cascade environments

## Requirements

- Cascade CMS 8.x or later
- Java 11+
- Cascade Asset Factory Plugin SDK

## Building

### Prerequisites

1. Download the [Cascade Asset Factory Plugin SDK](https://github.com/hannonhill/Cascade-Server-Asset-Factory-Plugin-SDK)
2. Install the SDK JAR to your local Maven repository:

```bash
mvn install:install-file \
  -Dfile=cascade-api-8.17.jar \
  -DgroupId=com.hannonhill.cascade \
  -DartifactId=cascade-api \
  -Dversion=8.17 \
  -Dpackaging=jar
```

### Build the Plugin

```bash
cd plugins/advanced-image-optimizer
mvn clean package
```

This creates a fat JAR at `target/advanced-image-optimizer-1.0.0.jar` containing all dependencies.

## Installation

### Self-Hosted Cascade

1. Copy the JAR to `<Tomcat>/webapps/ROOT/WEB-INF/lib/`
2. Restart Cascade CMS
3. Navigate to **Administration > Asset Factories > Manage Plugins**
4. Click **Add** and enter: `com.cascade.plugin.imageoptimizer.AdvancedImageOptimizerPlugin`

### Hannon Hill Hosted

Contact Hannon Hill support to request plugin deployment. Provide them with the JAR file.

**Note:** WebP encoding requires native libraries. If WebP is unavailable in hosted environments, the plugin will automatically fall back to JPEG output.

## Configuration

Add the plugin to an Asset Factory and configure these parameters:

| Parameter | Values | Default | Description |
|-----------|--------|---------|-------------|
| `outputFormat` | original, jpeg, png, webp | original | Target image format |
| `quality` | 0.0 - 1.0 | 0.8 | Compression quality (lossy formats) |
| `maxWidth` | pixels | (none) | Maximum output width |
| `maxHeight` | pixels | (none) | Maximum output height |
| `stripMetadata` | true, false | true | Remove EXIF/metadata |
| `additionalSizes` | e.g., "200x200, 400, 800x600" | (none) | Generate size variants |
| `sizeSuffixPattern` | e.g., "-{w}x{h}" | -{w}x{h} | Filename suffix for variants |
| `webpCompressionType` | lossy, lossless | lossy | WebP compression mode |
| `preserveAspectRatio` | true, false | true | Maintain aspect ratio |
| `scalingMethod` | speed, balanced, quality, ultra_quality | quality | Resize quality |

## Usage Examples

### Basic Optimization (JPEG, 80% quality)

```
outputFormat: jpeg
quality: 0.8
maxWidth: 1920
maxHeight: 1080
```

### WebP Conversion with Multiple Sizes

```
outputFormat: webp
quality: 0.75
maxWidth: 1600
additionalSizes: 400x300, 800x600, 1200
sizeSuffixPattern: -{w}w
```

This creates:
- `photo.webp` (max 1600px wide)
- `photo-400w.webp` (400x300)
- `photo-800w.webp` (800x600)
- `photo-1200w.webp` (1200px wide, auto height)

### High-Quality Archive

```
outputFormat: png
scalingMethod: ultra_quality
preserveAspectRatio: true
stripMetadata: false
```

## Dependencies

The plugin bundles these pure-Java libraries:

- [Thumbnailator](https://github.com/coobird/thumbnailator) - High-quality JPEG/PNG encoding
- [imgscalr](https://github.com/rkalla/imgscalr) - Fast, high-quality image scaling
- [webp-imageio](https://github.com/sejda-pdf/webp-imageio) - WebP encoding (includes native libs)
- [TwelveMonkeys ImageIO](https://github.com/haraldk/TwelveMonkeys) - Extended format support

## Comparison to Built-in Plugins

| Feature | Built-in Resize | This Plugin |
|---------|----------------|-------------|
| WebP output | No | Yes |
| Quality control | No | Yes (0.0-1.0) |
| Scaling algorithm | Basic | Progressive bilinear |
| Multiple sizes | Separate plugin | Single config |
| Metadata strip | No | Yes |

## Troubleshooting

### "WebP not available" warning

The webp-imageio library bundles native libraries for Windows, macOS, and Linux. If you see this warning:

1. Check server logs for native library loading errors
2. Verify the JAR wasn't stripped during deployment
3. Fall back to JPEG output (`outputFormat: jpeg`)

### Out of memory errors

Large images consume significant memory during processing. Reduce `maxPixels` in configuration or ask users to pre-resize extremely large images.

### Images look soft after resize

Increase `scalingMethod` to `quality` or `ultra_quality`. This uses more CPU but produces sharper results.

## License

MIT License - feel free to modify and distribute.

## Contributing

Issues and pull requests welcome at your repository URL.
