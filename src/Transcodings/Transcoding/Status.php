<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\Transcoding;

/**
 * Status reports processing or output expiry.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';

    case EXPIRED = 'expired';
}
