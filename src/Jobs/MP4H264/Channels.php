<?php

declare(strict_types=1);

namespace Chunkify\Jobs\MP4H264;

/**
 * Channels specifies the number of audio channels.
 * Valid values: 1 (mono), 2 (stereo), 5 (5.1), 7 (7.1).
 */
enum Channels: int
{
    case _1 = 1;

    case _2 = 2;

    case _5 = 5;

    case _7 = 7;
}
