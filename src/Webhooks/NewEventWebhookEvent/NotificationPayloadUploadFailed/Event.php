<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadFailed;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case UPLOAD_FAILED = 'upload.failed';

    case UPLOAD_EXPIRED = 'upload.expired';
}
