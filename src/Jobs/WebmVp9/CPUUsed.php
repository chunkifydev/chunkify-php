<?php

declare(strict_types=1);

namespace Chunkify\Jobs\WebmVp9;

/**
 * CpuUsed specifies the CPU usage level for VP9 encoding. Range: 0 to 8.
 * Lower values mean better quality but slower encoding, higher values mean faster encoding but lower quality.
 * Recommended values: 0-2 for high quality, 2-4 for good quality, 4-6 for balanced, 6-8 for speed.
 */
enum CPUUsed: string
{
    case _0 = '0';

    case _1 = '1';

    case _2 = '2';

    case _3 = '3';

    case _4 = '4';

    case _5 = '5';

    case _6 = '6';

    case _7 = '7';

    case _8 = '8';
}
