<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadSourceCreated;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case SOURCE_CREATED = 'source.created';
}
