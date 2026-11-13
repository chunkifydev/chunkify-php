<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingFileThumbnail\Format;

/**
 * An optional dashboard preview of the completed output.
 *
 * @phpstan-type TranscodingFileThumbnailShape = array{
 *   format: Format|value-of<Format>,
 *   height: int,
 *   size: int,
 *   url: string,
 *   width: int,
 * }
 */
final class TranscodingFileThumbnail implements BaseModel
{
    /** @use SdkModel<TranscodingFileThumbnailShape> */
    use SdkModel;

    /**
     * Format specifies the image encoding.
     *
     * @var value-of<Format> $format
     */
    #[Required(enum: Format::class)]
    public string $format;

    /**
     * Height specifies the measured image height in pixels.
     */
    #[Required]
    public int $height;

    /**
     * Size specifies the measured image size in bytes.
     */
    #[Required]
    public int $size;

    /**
     * Url provides a signed image URL valid for at most ten minutes.
     */
    #[Required]
    public string $url;

    /**
     * Width specifies the measured image width in pixels.
     */
    #[Required]
    public int $width;

    /**
     * `new TranscodingFileThumbnail()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscodingFileThumbnail::with(
     *   format: ..., height: ..., size: ..., url: ..., width: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscodingFileThumbnail)
     *   ->withFormat(...)
     *   ->withHeight(...)
     *   ->withSize(...)
     *   ->withURL(...)
     *   ->withWidth(...)
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
     * @param Format|value-of<Format> $format
     */
    public static function with(
        Format|string $format,
        int $height,
        int $size,
        string $url,
        int $width
    ): self {
        $self = new self;

        $self['format'] = $format;
        $self['height'] = $height;
        $self['size'] = $size;
        $self['url'] = $url;
        $self['width'] = $width;

        return $self;
    }

    /**
     * Format specifies the image encoding.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Height specifies the measured image height in pixels.
     */
    public function withHeight(int $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Size specifies the measured image size in bytes.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Url provides a signed image URL valid for at most ten minutes.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Width specifies the measured image width in pixels.
     */
    public function withWidth(int $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
