<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail;

/**
 * Status reports processing or output expiry.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
