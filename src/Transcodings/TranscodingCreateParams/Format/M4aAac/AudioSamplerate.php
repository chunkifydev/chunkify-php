<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams\Format\M4aAac;

/**
 * AudioSamplerate specifies the output sample rate in Hz. Defaults to 48000. WebM Opus audio uses 48000.
 */
enum AudioSamplerate: int
{
    case _8000 = 8000;

    case _11025 = 11025;

    case _12000 = 12000;

    case _16000 = 16000;

    case _22050 = 22050;

    case _24000 = 24000;

    case _32000 = 32000;

    case _44100 = 44100;

    case _48000 = 48000;

    case _64000 = 64000;

    case _88200 = 88200;

    case _96000 = 96000;
}
