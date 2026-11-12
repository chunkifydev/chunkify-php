<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingMP4Av1;

/**
 * Level specifies the AV1 level using its two-digit representation, such as 31 for level 3.1. The dimensions, frame rate and rate controls must fit this level. Omitted rate limits resolve to level-compatible defaults.
 */
enum Level: int
{
    case _30 = 30;

    case _31 = 31;

    case _41 = 41;
}
