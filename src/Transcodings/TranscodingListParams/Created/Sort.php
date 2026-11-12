<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingListParams\Created;

/**
 * Creation-time ordering. Defaults to newest first.
 */
enum Sort: string
{
    case ASC = 'asc';

    case DESC = 'desc';
}
