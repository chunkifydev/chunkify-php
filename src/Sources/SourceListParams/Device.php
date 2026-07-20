<?php

declare(strict_types=1);

namespace Chunkify\Sources\SourceListParams;

/**
 * Filter by device (apple/android).
 */
enum Device: string
{
    case APPLE = 'apple';

    case ANDROID = 'android';

    case UNKNOWN = 'unknown';
}
