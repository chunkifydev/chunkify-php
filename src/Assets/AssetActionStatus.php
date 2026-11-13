<?php

declare(strict_types=1);

namespace Chunkify\Assets;

/**
 * Current action status. pending means accepted; running means executing; waiting means awaiting Asset readiness or an output. completed, failed, skipped, and cancelled are terminal states.
 */
enum AssetActionStatus: string
{
    case PENDING = 'pending';

    case RUNNING = 'running';

    case WAITING = 'waiting';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case SKIPPED = 'skipped';

    case CANCELLED = 'cancelled';
}
