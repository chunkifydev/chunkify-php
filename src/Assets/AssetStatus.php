<?php

declare(strict_types=1);

namespace Chunkify\Assets;

enum AssetStatus: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
