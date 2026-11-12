<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\Thumbnail\File\Kind;

/**
 * One published image, sprite sheet, or WebVTT file.
 *
 * @phpstan-type FileShape = array{
 *   kind: Kind|value-of<Kind>,
 *   path: string,
 *   size: int,
 *   cdnURL?: string|null,
 *   height?: int|null,
 *   url?: string|null,
 *   width?: int|null,
 * }
 */
final class File implements BaseModel
{
    /** @use SdkModel<FileShape> */
    use SdkModel;

    /**
     * Kind identifies an individual image, sprite sheet, or WebVTT index.
     *
     * @var value-of<Kind> $kind
     */
    #[Required(enum: Kind::class)]
    public string $kind;

    /**
     * Path specifies the file relative to storage_prefix.
     */
    #[Required]
    public string $path;

    /**
     * Size specifies the measured encoded file size in bytes.
     */
    #[Required]
    public int $size;

    /**
     * CdnUrl provides delivery through the configured CDN. Omitted without a CDN or after expiry.
     */
    #[Optional('cdn_url')]
    public ?string $cdnURL;

    /**
     * Height specifies the measured image or complete sprite canvas height. Omitted for WebVTT.
     */
    #[Optional]
    public ?int $height;

    /**
     * Url provides temporary authorized delivery. Omitted after expiry or when unavailable.
     */
    #[Optional]
    public ?string $url;

    /**
     * Width specifies the measured image or complete sprite canvas width. Omitted for WebVTT.
     */
    #[Optional]
    public ?int $width;

    /**
     * `new File()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * File::with(kind: ..., path: ..., size: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new File)->withKind(...)->withPath(...)->withSize(...)
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
     * @param Kind|value-of<Kind> $kind
     */
    public static function with(
        Kind|string $kind,
        string $path,
        int $size,
        ?string $cdnURL = null,
        ?int $height = null,
        ?string $url = null,
        ?int $width = null,
    ): self {
        $self = new self;

        $self['kind'] = $kind;
        $self['path'] = $path;
        $self['size'] = $size;

        null !== $cdnURL && $self['cdnURL'] = $cdnURL;
        null !== $height && $self['height'] = $height;
        null !== $url && $self['url'] = $url;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Kind identifies an individual image, sprite sheet, or WebVTT index.
     *
     * @param Kind|value-of<Kind> $kind
     */
    public function withKind(Kind|string $kind): self
    {
        $self = clone $this;
        $self['kind'] = $kind;

        return $self;
    }

    /**
     * Path specifies the file relative to storage_prefix.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Size specifies the measured encoded file size in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * CdnUrl provides delivery through the configured CDN. Omitted without a CDN or after expiry.
     */
    public function withCdnURL(string $cdnURL): self
    {
        $self = clone $this;
        $self['cdnURL'] = $cdnURL;

        return $self;
    }

    /**
     * Height specifies the measured image or complete sprite canvas height. Omitted for WebVTT.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Url provides temporary authorized delivery. Omitted after expiry or when unavailable.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Width specifies the measured image or complete sprite canvas width. Omitted for WebVTT.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
