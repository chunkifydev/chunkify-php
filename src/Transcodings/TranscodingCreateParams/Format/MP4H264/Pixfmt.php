<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264;

/**
 * Pixfmt specifies the output pixel format. Defaults to yuv420p. The selected profile must support it.
 */
enum Pixfmt: string
{
    case YUV420P = 'yuv420p';

    case YUV422P = 'yuv422p';

    case YUV444P = 'yuv444p';

    case YUV420P10LE = 'yuv420p10le';

    case YUV422P10LE = 'yuv422p10le';

    case YUV444P10LE = 'yuv444p10le';
}
