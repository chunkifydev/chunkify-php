<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams\Format\MP4Av1;

/**
 * Pixfmt specifies the output pixel format. Defaults to yuv420p. The selected profile must support it.
 */
enum Pixfmt: string
{
    case YUV420P = 'yuv420p';

    case YUV420P10LE = 'yuv420p10le';
}
