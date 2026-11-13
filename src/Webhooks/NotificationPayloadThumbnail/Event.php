<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadThumbnail;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case THUMBNAIL_CREATED = 'thumbnail.created';

    case THUMBNAIL_READY = 'thumbnail.ready';

    case THUMBNAIL_FAILED = 'thumbnail.failed';

    case THUMBNAIL_EXPIRED = 'thumbnail.expired';

    case THUMBNAIL_DELETED = 'thumbnail.deleted';
}
