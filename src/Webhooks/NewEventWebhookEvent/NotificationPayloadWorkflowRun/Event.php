<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadWorkflowRun;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case WORKFLOW_RUN_CREATED = 'workflow_run.created';

    case WORKFLOW_RUN_COMPLETED = 'workflow_run.completed';

    case WORKFLOW_RUN_FAILED = 'workflow_run.failed';

    case WORKFLOW_RUN_CANCELLED = 'workflow_run.cancelled';
}
