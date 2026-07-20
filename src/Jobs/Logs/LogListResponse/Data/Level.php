<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Logs\LogListResponse\Data;

/**
 * Log level.
 */
enum Level: string
{
    case INFO = 'info';

    case ERROR = 'error';

    case DEBUG = 'debug';
}
