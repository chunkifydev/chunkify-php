<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Logs\LogListParams;

/**
 * Service type (transcoder or manager).
 */
enum Service: string
{
    case TRANSCODER = 'transcoder';

    case MANAGER = 'manager';
}
