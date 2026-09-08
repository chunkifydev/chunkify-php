<?php

declare(strict_types=1);

namespace Chunkify\Jobs\JobListParams;

/**
 * Filter by job status.
 */
enum Status: string
{
    case COMPLETED = 'completed';

    case PROCESSING = 'processing';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';

    case QUEUED = 'queued';

    case PENDING = 'pending';
}
