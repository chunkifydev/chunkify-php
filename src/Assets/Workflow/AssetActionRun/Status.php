<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\AssetActionRun;

/**
 * Current execution status of the action.
 */
enum Status: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case WAITING = 'waiting';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case SKIPPED = 'skipped';

    case CANCELLED = 'cancelled';
}
