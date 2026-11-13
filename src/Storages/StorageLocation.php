<?php

declare(strict_types=1);

namespace Chunkify\Storages;

/**
 * Location specifies the location of the storage provider.
 */
enum StorageLocation: string
{
    case US = 'US';

    case EU = 'EU';

    case ASIA = 'ASIA';
}
