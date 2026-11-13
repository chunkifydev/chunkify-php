<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetStaticRendition;

/**
 * Processing status of this MP4, independent of streaming outputs.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
