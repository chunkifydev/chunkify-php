<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs\Actions\ActionListParams;

/**
 * Status specifies the action status to filter by. Omit it to include all statuses.
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
