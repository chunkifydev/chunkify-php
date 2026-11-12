<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputListParams;

/**
 * Status specifies the current output state to include. Omit it to include all states.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
