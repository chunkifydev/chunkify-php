<?php

declare(strict_types=1);

namespace Chunkify\Jobs\JobListParams\Created;

/**
 * Sort by creation date (asc/desc).
 */
enum Sort: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
