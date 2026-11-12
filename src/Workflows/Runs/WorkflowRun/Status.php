<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs\WorkflowRun;

/**
 * Current status of this event run, based on its own actions.
 */
enum Status: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
