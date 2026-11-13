<?php

declare(strict_types=1);

namespace Chunkify\Log;

/**
 * Log level.
 */
enum Level: string
{
    case INFO = 'info';

    case ERROR = 'error';

    case DEBUG = 'debug';
}
