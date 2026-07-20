<?php

declare(strict_types=1);

namespace Chunkify\Jobs\MP4H264;

/**
 * Preset specifies the encoding speed preset. Valid values (from fastest to slowest):
 * - ultrafast: Fastest encoding, lowest quality
 * - superfast: Very fast encoding, lower quality
 * - veryfast: Fast encoding, moderate quality
 * - faster: Faster encoding, good quality
 * - fast: Fast encoding, better quality
 * - medium: Balanced preset, best quality
 */
enum Preset: string
{
    case ULTRAFAST = 'ultrafast';

    case SUPERFAST = 'superfast';

    case VERYFAST = 'veryfast';

    case FASTER = 'faster';

    case FAST = 'fast';

    case MEDIUM = 'medium';
}
