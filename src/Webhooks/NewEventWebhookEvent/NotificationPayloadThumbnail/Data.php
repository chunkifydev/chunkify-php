<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadThumbnail;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Thumbnails\Thumbnail;

/**
 * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
 *
 * @phpstan-import-type ThumbnailShape from \Chunkify\Thumbnails\Thumbnail
 *
 * @phpstan-type DataShape = array{thumbnail: Thumbnail|ThumbnailShape}
 */
final class Data implements BaseModel
{
    /** @use SdkModel<DataShape> */
    use SdkModel;

    /**
     * Thumbnail contains the resource at the event time.
     */
    #[Required]
    public Thumbnail $thumbnail;

    /**
     * `new Data()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Data::with(thumbnail: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Data)->withThumbnail(...)
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
