<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\Thumbnail\Sample\Crop;

/**
 * One successfully published requested sample. Repeated samples remain separate entries.
 *
 * @phpstan-import-type CropShape from \Chunkify\Thumbnails\Thumbnail\Sample\Crop
 *
 * @phpstan-type SampleShape = array{
 *   height: int,
 *   path: string,
 *   timestamp: float,
 *   width: int,
 *   crop?: null|Crop|CropShape,
 * }
 */
final class Sample implements BaseModel
{
    /** @use SdkModel<SampleShape> */
    use SdkModel;

    /**
     * Height specifies this image or tile height in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Path identifies the image or sprite sheet in files.
     */
    #[Required]
    public string $path;

    /**
     * Timestamp specifies the measured Source-relative presentation time of the selected frame in seconds. Compatible cached inputs use millisecond timestamps, which can select a neighboring frame compared with the original Source.
     */
    #[Required]
    public float $timestamp;

    /**
     * Width specifies this image or tile width in pixels.
     */
    #[Required]
    public int $width;

    /**
     * Crop specifies the tile origin in its sprite sheet. Omitted for individual images; width and height give the tile dimensions.
     */
    #[Optional]
    public ?Crop $crop;

    /**
     * `new Sample()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Sample::with(height: ..., path: ..., timestamp: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Sample)->withHeight(...)->withPath(...)->withTimestamp(...)->withWidth(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Crop|CropShape|null $crop
     */
    public static function with(
        int $height,
        string $path,
        float $timestamp,
        int $width,
        Crop|array|null $crop = null,
    ): self {
        $self = new self;

        $self['height'] = $height;
        $self['path'] = $path;
        $self['timestamp'] = $timestamp;
        $self['width'] = $width;

        null !== $crop && $self['crop'] = $crop;

        return $self;
    }

    /**
     * Height specifies this image or tile height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Path identifies the image or sprite sheet in files.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Timestamp specifies the measured Source-relative presentation time of the selected frame in seconds. Compatible cached inputs use millisecond timestamps, which can select a neighboring frame compared with the original Source.
     */
    public function withTimestamp(float $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Width specifies this image or tile width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Crop specifies the tile origin in its sprite sheet. Omitted for individual images; width and height give the tile dimensions.
     *
     * @param Crop|CropShape $crop
     */
    public function withCrop(Crop|array $crop): self
    {
        $self = clone $this;
        $self['crop'] = $crop;

        return $self;
    }
}
