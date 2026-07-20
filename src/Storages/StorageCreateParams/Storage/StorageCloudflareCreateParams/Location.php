<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams\Storage\StorageCloudflareCreateParams;

/**
 * Location specifies the location of the storage provider.
 */
enum Location: string
{
    case US = 'US';

    case EU = 'EU';

    case ASIA = 'ASIA';
}
