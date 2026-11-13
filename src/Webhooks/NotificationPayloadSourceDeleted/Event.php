<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadSourceDeleted;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case SOURCE_DELETED = 'source.deleted';
}
