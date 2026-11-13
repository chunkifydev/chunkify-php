<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\TranscodingFormat;

/**
 * Id specifies the resolved container and codec selection.
 */
enum ID: string
{
    case MP4_H264 = 'mp4_h264';

    case MP4_H265 = 'mp4_h265';

    case MP4_AV1 = 'mp4_av1';

    case WEBM_VP9 = 'webm_vp9';

    case M4A_AAC = 'm4a_aac';
}
