<?php

declare(strict_types=1);

namespace Chunkify\Jobs\MP4Av1;

/**
 * Preset controls the encoding efficiency and processing intensity. Lower presets use more
 * optimization features, creating smaller files with better quality but requiring more compute time.
 * Higher presets encode faster but produce larger files.
 *
 * Preset ranges:
 * - 6-7: Fast encoding for real-time applications (smaller files)
 * - 8-10: Balanced efficiency and speed for general use
 * - 11-13: Fastest encoding for real-time applications (larger files)
 */
enum Preset: string
{
    case _6 = '6';

    case _7 = '7';

    case _8 = '8';

    case _9 = '9';

    case _10 = '10';

    case _11 = '11';

    case _12 = '12';

    case _13 = '13';
}
