<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingWebmVp9;

/**
 * Pixfmt specifies the output pixel format. Defaults to yuv420p. The selected profile must support it.
 */
enum Pixfmt: string
{
    case YUV420P = 'yuv420p';

    case YUV422P = 'yuv422p';

    case YUV440P = 'yuv440p';

    case YUV444P = 'yuv444p';

    case YUV420P10LE = 'yuv420p10le';

    case YUV422P10LE = 'yuv422p10le';

    case YUV440P10LE = 'yuv440p10le';

    case YUV444P10LE = 'yuv444p10le';

    case YUV420P12LE = 'yuv420p12le';

    case YUV422P12LE = 'yuv422p12le';

    case YUV440P12LE = 'yuv440p12le';

    case YUV444P12LE = 'yuv444p12le';
}
