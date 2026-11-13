<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetTimelinePreviewsShape = array{
 *   format: 'sprite',
 *   vttPath: string,
 *   cdnURL?: string|null,
 *   imageCount?: int|null,
 *   intervalSeconds?: float|null,
 *   previewURL?: string|null,
 *   size?: int|null,
 *   spriteCount?: int|null,
 *   thumbnailHeight?: int|null,
 *   thumbnailWidth?: int|null,
 * }
 */
final class AssetTimelinePreviews implements BaseModel
{
    /** @use SdkModel<AssetTimelinePreviewsShape> */
    use SdkModel;

    /**
     * Thumbnail image layout.
     *
     * @var 'sprite' $format
     */
    #[Required]
    public string $format = 'sprite';

    /**
     * WebVTT file path in Storage.
     */
    #[Required('vtt_path')]
    public string $vttPath;

    /**
     * Unsigned WebVTT CDN URL. Available when the Asset is ready and Storage has a CDN URL.
     */
    #[Optional('cdn_url')]
    public ?string $cdnURL;

    /**
     * Number of thumbnails.
     */
    #[Optional('image_count')]
    public ?int $imageCount;

    /**
     * Target thumbnail sampling interval in seconds. The WebVTT file provides actual cue timestamps.
     */
    #[Optional('interval_seconds')]
    public ?float $intervalSeconds;

    /**
     * Public WebVTT preview URL with signed image references. Available when the Asset is ready and preview_enabled is true.
     */
    #[Optional('preview_url')]
    public ?string $previewURL;

    /**
     * Combined WebVTT and sprite image size in bytes.
     */
    #[Optional]
    public ?int $size;

    /**
     * Number of sprite images containing the thumbnails.
     */
    #[Optional('sprite_count')]
    public ?int $spriteCount;

    /**
     * Thumbnail height in pixels.
     */
    #[Optional('thumbnail_height')]
    public ?int $thumbnailHeight;

    /**
     * Thumbnail width in pixels.
     */
    #[Optional('thumbnail_width')]
    public ?int $thumbnailWidth;

    /**
     * `new AssetTimelinePreviews()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetTimelinePreviews::with(vttPath: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetTimelinePreviews)->withVttPath(...)
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
     */
    public static function with(
        string $vttPath,
        ?string $cdnURL = null,
        ?int $imageCount = null,
        ?float $intervalSeconds = null,
        ?string $previewURL = null,
        ?int $size = null,
        ?int $spriteCount = null,
        ?int $thumbnailHeight = null,
        ?int $thumbnailWidth = null,
    ): self {
        $self = new self;

        $self['vttPath'] = $vttPath;

        null !== $cdnURL && $self['cdnURL'] = $cdnURL;
        null !== $imageCount && $self['imageCount'] = $imageCount;
        null !== $intervalSeconds && $self['intervalSeconds'] = $intervalSeconds;
        null !== $previewURL && $self['previewURL'] = $previewURL;
        null !== $size && $self['size'] = $size;
        null !== $spriteCount && $self['spriteCount'] = $spriteCount;
        null !== $thumbnailHeight && $self['thumbnailHeight'] = $thumbnailHeight;
        null !== $thumbnailWidth && $self['thumbnailWidth'] = $thumbnailWidth;

        return $self;
    }

    /**
     * Thumbnail image layout.
     *
     * @param 'sprite' $format
     */
    public function withFormat(string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * WebVTT file path in Storage.
     */
    public function withVttPath(string $vttPath): self
    {
        $self = clone $this;
        $self['vttPath'] = $vttPath;

        return $self;
    }

    /**
     * Unsigned WebVTT CDN URL. Available when the Asset is ready and Storage has a CDN URL.
     */
    public function withCdnURL(string $cdnURL): self
    {
        $self = clone $this;
        $self['cdnURL'] = $cdnURL;

        return $self;
    }

    /**
     * Number of thumbnails.
     */
    public function withImageCount(int $imageCount): self
    {
        $self = clone $this;
        $self['imageCount'] = $imageCount;

        return $self;
    }

    /**
     * Target thumbnail sampling interval in seconds. The WebVTT file provides actual cue timestamps.
     */
    public function withIntervalSeconds(float $intervalSeconds): self
    {
        $self = clone $this;
        $self['intervalSeconds'] = $intervalSeconds;

        return $self;
    }

    /**
     * Public WebVTT preview URL with signed image references. Available when the Asset is ready and preview_enabled is true.
     */
    public function withPreviewURL(string $previewURL): self
    {
        $self = clone $this;
        $self['previewURL'] = $previewURL;

        return $self;
    }

    /**
     * Combined WebVTT and sprite image size in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Number of sprite images containing the thumbnails.
     */
    public function withSpriteCount(int $spriteCount): self
    {
        $self = clone $this;
        $self['spriteCount'] = $spriteCount;

        return $self;
    }

    /**
     * Thumbnail height in pixels.
     */
    public function withThumbnailHeight(int $thumbnailHeight): self
    {
        $self = clone $this;
        $self['thumbnailHeight'] = $thumbnailHeight;

        return $self;
    }

    /**
     * Thumbnail width in pixels.
     */
    public function withThumbnailWidth(int $thumbnailWidth): self
    {
        $self = clone $this;
        $self['thumbnailWidth'] = $thumbnailWidth;

        return $self;
    }
}
