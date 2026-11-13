<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

/**
 * Current run status. pending means its actions have not started; running means work remains. After all actions finish, failed takes precedence over cancelled. Otherwise the run is completed, including when actions were skipped.
 */
enum WorkflowRunStatus: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
