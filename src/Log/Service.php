<?php

declare(strict_types=1);

namespace Chunkify\Log;

/**
 * Name of the service that generated the log.
 */
enum Service: string
{
    case TRANSCODER = 'transcoder';

    case MANAGER = 'manager';
}
