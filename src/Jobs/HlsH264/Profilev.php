<?php

declare(strict_types=1);

namespace Chunkify\Jobs\HlsH264;

/**
 * Profilev specifies the H.264 profile. Valid values:
 * - baseline: Basic profile, good for mobile devices
 * - main: Main profile, good for most applications
 * - high: High profile, best quality but requires more processing
 * - high10: High 10-bit profile, supports 10-bit color
 * - high422: High 4:2:2 profile, supports 4:2:2 color sampling
 * - high444: High 4:4:4 profile, supports 4:4:4 color sampling
 */
enum Profilev: string
{
    case BASELINE = 'baseline';

    case MAIN = 'main';

    case HIGH = 'high';

    case HIGH10 = 'high10';

    case HIGH422 = 'high422';

    case HIGH444 = 'high444';
}
