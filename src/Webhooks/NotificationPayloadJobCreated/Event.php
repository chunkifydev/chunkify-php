<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadJobCreated;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case JOB_CREATED = 'job.created';
}
