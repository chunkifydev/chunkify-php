<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingListParams;

/**
 * Filter by Transcoding status.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';

    case EXPIRED = 'expired';
}
