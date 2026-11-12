<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail\Sample;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Crop specifies the tile origin in its sprite sheet. Omitted for individual images; width and height give the tile dimensions.
 *
 * @phpstan-type CropShape = array{x: int, y: int}
 */
final class Crop implements BaseModel
{
    /** @use SdkModel<CropShape> */
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
     * `new Crop()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Crop::with(x: ..., y: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Crop)->withX(...)->withY(...)
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
