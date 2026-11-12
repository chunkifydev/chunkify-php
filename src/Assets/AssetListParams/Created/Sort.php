<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetListParams\Created;

/**
 * Creation-time ordering. Defaults to newest first.
 */
enum Sort: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
