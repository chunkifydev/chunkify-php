<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs\RunListParams;

/**
 * Status specifies the run status to filter by. Omit it to include all statuses.
 */
enum Status: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
