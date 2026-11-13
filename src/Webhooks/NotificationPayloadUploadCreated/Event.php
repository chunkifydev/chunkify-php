<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadUploadCreated;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case UPLOAD_CREATED = 'upload.created';
}
