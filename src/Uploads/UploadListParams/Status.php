<?php

declare(strict_types=1);

namespace Chunkify\Uploads\UploadListParams;

/**
 * Filter by status (pending, completed, error).
 */
enum Status: string
{
    case WAITING = 'waiting';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
