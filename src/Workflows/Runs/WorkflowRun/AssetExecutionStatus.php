<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs\WorkflowRun;

/**
 * AssetExecutionStatus specifies the combined status of this revision for the Asset across retained runs.
 * Any failed action or run makes it failed. Pending or active work, or an Asset still preparing for an unarchived Workflow, makes it running. Otherwise it is completed.
 */
enum AssetExecutionStatus: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
