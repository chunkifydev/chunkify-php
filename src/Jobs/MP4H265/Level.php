<?php

declare(strict_types=1);

namespace Chunkify\Jobs\MP4H265;

/**
 * Level specifies the H.265 profile level. Valid values: 30-31 (main), 41 (main10).
 * Higher levels support higher resolutions and bitrates but require more processing power.
 */
enum Level: int
{
    case _30 = 30;

    case _31 = 31;

    case _41 = 41;
}
