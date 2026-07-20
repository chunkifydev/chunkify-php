<?php

declare(strict_types=1);

namespace Chunkify\Jobs\MP4H264;

/**
 * Level specifies the H.264 profile level. Valid values: 10-13 (baseline), 20-22 (main), 30-32 (high), 40-42 (high), 50-51 (high).
 * Higher levels support higher resolutions and bitrates but require more processing power.
 */
enum Level: int
{
    case _10 = 10;

    case _11 = 11;

    case _12 = 12;

    case _13 = 13;

    case _20 = 20;

    case _21 = 21;

    case _22 = 22;

    case _30 = 30;

    case _31 = 31;

    case _32 = 32;

    case _40 = 40;

    case _41 = 41;

    case _42 = 42;

    case _50 = 50;

    case _51 = 51;
}
