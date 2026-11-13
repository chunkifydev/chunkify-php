<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetListParams;

/**
 * Filter by Asset status.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
