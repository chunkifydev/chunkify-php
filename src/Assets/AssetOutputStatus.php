<?php

declare(strict_types=1);

namespace Chunkify\Assets;

/**
 * Status specifies the output processing state. Expired means temporary output files are no longer available.
 */
enum AssetOutputStatus: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
