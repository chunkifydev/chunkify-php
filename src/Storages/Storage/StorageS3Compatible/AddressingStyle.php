<?php

declare(strict_types=1);

namespace Chunkify\Storages\Storage\StorageS3Compatible;

/**
 * Addressing style detected during connection validation and used for later S3 operations.
 */
enum AddressingStyle: string
{
    case VIRTUAL = 'virtual';

    case PATH = 'path';
}
