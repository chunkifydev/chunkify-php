<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * The image rectangle within a sprite sheet.
 *
 * @phpstan-type ThumbnailCropShape = array{x: int, y: int}
 */
final class ThumbnailCrop implements BaseModel
{
    /** @use SdkModel<ThumbnailCropShape> */
    use SdkModel;

    /**
     * X specifies the left edge in pixels.
     */
    #[Required]
    public int $x;

    /**
     * Y specifies the top edge in pixels.
     */
    #[Required]
    public int $y;

    /**
     * `new ThumbnailCrop()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ThumbnailCrop::with(x: ..., y: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ThumbnailCrop)->withX(...)->withY(...)
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
    public static function with(int $x, int $y): self
    {
        $self = new self;

        $self['x'] = $x;
        $self['y'] = $y;

        return $self;
    }

    /**
     * X specifies the left edge in pixels.
     */
    public function withX(int $x): self
    {
        $self = clone $this;
        $self['x'] = $x;

        return $self;
    }

    /**
     * Y specifies the top edge in pixels.
     */
    public function withY(int $y): self
    {
        $self = clone $this;
        $self['y'] = $y;

        return $self;
    }
}
