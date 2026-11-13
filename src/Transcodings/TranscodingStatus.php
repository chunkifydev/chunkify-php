<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

/**
 * Status is ready only after the output is validated and published. Temporary output becomes expired when its files are no longer available.
 */
enum TranscodingStatus: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';

    case EXPIRED = 'expired';
}
