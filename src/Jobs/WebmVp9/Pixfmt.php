<?php

declare(strict_types=1);

namespace Chunkify\Jobs\WebmVp9;

/**
 * PixFmt specifies the pixel format.
 * Valid value: yuv420p.
 */
enum Pixfmt: string
{
    case YUV410P = 'yuv410p';

    case YUV411P = 'yuv411p';

    case YUV420P = 'yuv420p';

    case YUV422P = 'yuv422p';

    case YUV440P = 'yuv440p';

    case YUV444P = 'yuv444p';

    case YUV_J411P = 'yuvJ411p';

    case YUV_J420P = 'yuvJ420p';

    case YUV_J422P = 'yuvJ422p';

    case YUV_J440P = 'yuvJ440p';

    case YUV_J444P = 'yuvJ444p';

    case YUV420P10LE = 'yuv420p10le';

    case YUV422P10LE = 'yuv422p10le';

    case YUV440P10LE = 'yuv440p10le';

    case YUV444P10LE = 'yuv444p10le';

    case YUV420P12LE = 'yuv420p12le';

    case YUV422P12LE = 'yuv422p12le';

    case YUV440P12LE = 'yuv440p12le';

    case YUV444P12LE = 'yuv444p12le';

    case YUV420P10BE = 'yuv420p10be';

    case YUV422P10BE = 'yuv422p10be';

    case YUV440P10BE = 'yuv440p10be';

    case YUV444P10BE = 'yuv444p10be';

    case YUV420P12BE = 'yuv420p12be';

    case YUV422P12BE = 'yuv422p12be';

    case YUV440P12BE = 'yuv440p12be';

    case YUV444P12BE = 'yuv444p12be';
}
