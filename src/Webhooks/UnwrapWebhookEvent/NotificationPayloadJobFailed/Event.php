<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobFailed;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case JOB_FAILED = 'job.failed';

    case JOB_CANCELLED = 'job.cancelled';
}
