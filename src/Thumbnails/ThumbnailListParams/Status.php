<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\ThumbnailListParams;

/**
 * Filter by Thumbnail status.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
