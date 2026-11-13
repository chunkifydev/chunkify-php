<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadJobCompleted;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case JOB_COMPLETED = 'job.completed';
}
