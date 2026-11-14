<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

/**
 * Status is ready only after processing and publication finish. Temporary outputs become expired after their retention period.
 */
enum ThumbnailStatus: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
