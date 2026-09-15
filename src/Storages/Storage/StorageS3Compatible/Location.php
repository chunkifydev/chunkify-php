<?php

declare(strict_types=1);

namespace Chunkify\Storages\Storage\StorageS3Compatible;

/**
 * Chunkify workload location. This is independent from the provider signing region.
 */
enum Location: string
{
    case US = 'US';

    case EU = 'EU';

    case ASIA = 'ASIA';
}
