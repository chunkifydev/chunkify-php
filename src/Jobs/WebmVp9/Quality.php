<?php

declare(strict_types=1);

namespace Chunkify\Jobs\WebmVp9;

/**
 * Quality specifies the VP9 encoding quality preset. Valid values:
 * - good: Balanced quality preset, good for most applications
 * - best: Best quality preset, slower encoding
 * - realtime: Fast encoding preset, suitable for live streaming
 */
enum Quality: string
{
    case GOOD = 'good';

    case BEST = 'best';

    case REALTIME = 'realtime';
}
