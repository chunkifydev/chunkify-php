<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetPosterShape = array{
 *   height: int,
 *   path: string,
 *   width: int,
 *   cdnURL?: string|null,
 *   previewURL?: string|null,
 *   size?: int|null,
 *   timeSeconds?: float|null,
 *   url?: string|null,
 * }
 */
final class AssetPoster implements BaseModel
{
    /** @use SdkModel<AssetPosterShape> */
    use SdkModel;

    /**
     * Image height in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Image path in Storage.
     */
    #[Required]
    public string $path;

    /**
     * Image width in pixels.
     */
    #[Required]
    public int $width;

    /**
     * Unsigned image CDN URL. Available once the poster exists and Storage has a CDN URL.
     */
    #[Optional('cdn_url')]
    public ?string $cdnURL;

    /**
     * Public poster preview URL. Available when the Asset is ready and preview_enabled is true.
     */
    #[Optional('preview_url')]
    public ?string $previewURL;

    /**
     * Image size in bytes.
     */
    #[Optional]
    public ?int $size;

    /**
     * Position of the selected frame in seconds.
     */
    #[Optional('time_seconds')]
    public ?float $timeSeconds;

    /**
     * Signed image URL, valid for up to ten minutes. Available once the poster exists, regardless of preview_enabled.
     */
    #[Optional]
    public ?string $url;

    /**
     * `new AssetPoster()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetPoster::with(height: ..., path: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetPoster)->withHeight(...)->withPath(...)->withWidth(...)
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
        int $height,
        string $path,
        int $width,
        ?string $cdnURL = null,
        ?string $previewURL = null,
        ?int $size = null,
        ?float $timeSeconds = null,
        ?string $url = null,
    ): self {
        $self = new self;

        $self['height'] = $height;
        $self['path'] = $path;
        $self['width'] = $width;

        null !== $cdnURL && $self['cdnURL'] = $cdnURL;
        null !== $previewURL && $self['previewURL'] = $previewURL;
        null !== $size && $self['size'] = $size;
        null !== $timeSeconds && $self['timeSeconds'] = $timeSeconds;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Image height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Image path in Storage.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Image width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Unsigned image CDN URL. Available once the poster exists and Storage has a CDN URL.
     */
    public function withCdnURL(string $cdnURL): self
    {
        $self = clone $this;
        $self['cdnURL'] = $cdnURL;

        return $self;
    }

    /**
     * Public poster preview URL. Available when the Asset is ready and preview_enabled is true.
     */
    public function withPreviewURL(string $previewURL): self
    {
        $self = clone $this;
        $self['previewURL'] = $previewURL;

        return $self;
    }

    /**
     * Image size in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Position of the selected frame in seconds.
     */
    public function withTimeSeconds(float $timeSeconds): self
    {
        $self = clone $this;
        $self['timeSeconds'] = $timeSeconds;

        return $self;
    }

    /**
     * Signed image URL, valid for up to ten minutes. Available once the poster exists, regardless of preview_enabled.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
