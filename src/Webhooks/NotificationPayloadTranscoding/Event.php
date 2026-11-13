<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadTranscoding;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case TRANSCODING_CREATED = 'transcoding.created';

    case TRANSCODING_READY = 'transcoding.ready';

    case TRANSCODING_FAILED = 'transcoding.failed';

    case TRANSCODING_CANCELLED = 'transcoding.cancelled';

    case TRANSCODING_EXPIRED = 'transcoding.expired';

    case TRANSCODING_DELETED = 'transcoding.deleted';
}
