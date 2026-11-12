<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\AssetOutput\AssetStaticRenditionOutput\Details;

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
