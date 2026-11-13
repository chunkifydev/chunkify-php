<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadUploadCompleted;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case UPLOAD_COMPLETED = 'upload.completed';
}
