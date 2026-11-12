<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage\Daily;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Thumbnail processing usage.
 *
 * @phpstan-type ThumbnailsShape = array{
 *   imagesPublished: int, setsFailed: int, setsReady: int
 * }
 */
final class Thumbnails implements BaseModel
{
    /** @use SdkModel<ThumbnailsShape> */
    use SdkModel;

    /**
     * ImagesPublished specifies the number of published thumbnail images.
     */
    #[Required('images_published')]
    public int $imagesPublished;

    /**
     * SetsFailed specifies recorded failed Thumbnail requests.
     */
    #[Required('sets_failed')]
    public int $setsFailed;

    /**
     * SetsReady specifies recorded successful Thumbnail requests.
     */
    #[Required('sets_ready')]
    public int $setsReady;

    /**
     * `new Thumbnails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Thumbnails::with(imagesPublished: ..., setsFailed: ..., setsReady: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Thumbnails)
     *   ->withImagesPublished(...)
     *   ->withSetsFailed(...)
     *   ->withSetsReady(...)
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
        int $imagesPublished,
        int $setsFailed,
        int $setsReady
    ): self {
        $self = new self;

        $self['imagesPublished'] = $imagesPublished;
        $self['setsFailed'] = $setsFailed;
        $self['setsReady'] = $setsReady;

        return $self;
    }

    /**
     * ImagesPublished specifies the number of published thumbnail images.
     */
    public function withImagesPublished(int $imagesPublished): self
    {
        $self = clone $this;
        $self['imagesPublished'] = $imagesPublished;

        return $self;
    }

    /**
     * SetsFailed specifies recorded failed Thumbnail requests.
     */
    public function withSetsFailed(int $setsFailed): self
    {
        $self = clone $this;
        $self['setsFailed'] = $setsFailed;

        return $self;
    }

    /**
     * SetsReady specifies recorded successful Thumbnail requests.
     */
    public function withSetsReady(int $setsReady): self
    {
        $self = clone $this;
        $self['setsReady'] = $setsReady;

        return $self;
    }
}
