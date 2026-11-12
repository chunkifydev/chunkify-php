<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\UnwrapWebhookEvent\Data;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\Thumbnail;

/**
 * A canonical thumbnail snapshot for standalone thumbnail.* events. Asset-owned thumbnails use the Asset output event payload.
 *
 * @phpstan-import-type ThumbnailShape from \Chunkify\Thumbnails\Thumbnail
 *
 * @phpstan-type ThumbnailEventDataShape = array{
 *   thumbnail: Thumbnail|ThumbnailShape
 * }
 */
final class ThumbnailEventData implements BaseModel
{
    /** @use SdkModel<ThumbnailEventDataShape> */
    use SdkModel;

    /**
     * Thumbnail contains the resource at the event time.
     */
    #[Required]
    public Thumbnail $thumbnail;

    /**
     * `new ThumbnailEventData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ThumbnailEventData::with(thumbnail: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ThumbnailEventData)->withThumbnail(...)
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
     * @param Thumbnail|ThumbnailShape $thumbnail
     */
    public static function with(Thumbnail|array $thumbnail): self
    {
        $self = new self;

        $self['thumbnail'] = $thumbnail;

        return $self;
    }

    /**
     * Thumbnail contains the resource at the event time.
     *
     * @param Thumbnail|ThumbnailShape $thumbnail
     */
    public function withThumbnail(Thumbnail|array $thumbnail): self
    {
        $self = clone $this;
        $self['thumbnail'] = $thumbnail;

        return $self;
    }
}
