<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams\Storage\StorageS3CompatibleCreateParams;

/**
 * Chunkify workload location. It controls where Chunkify processes the workload and is independent from the provider region.
 */
enum Location: string
{
    case US = 'US';

    case EU = 'EU';

    case ASIA = 'ASIA';
}
