<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingM4aAac;

/**
 * Channels specifies the output channel count. Defaults to stereo. Six channels means 5.1; eight means 7.1.
 */
enum Channels: int
{
    case _1 = 1;

    case _2 = 2;

    case _6 = 6;

    case _8 = 8;
}
