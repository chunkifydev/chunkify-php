<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingMP4H265;

/**
 * Movflags specifies MP4 packaging. Defaults to faststart, which places playback metadata before the media.
 */
enum Movflags: string
{
    case FASTSTART = 'faststart';
}
