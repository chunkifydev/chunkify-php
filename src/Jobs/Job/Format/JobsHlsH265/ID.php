<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job\Format\JobsHlsH265;

/**
 * The format ID.
 */
enum ID: string
{
    case MP4_H264 = 'mp4_h264';

    case MP4_H265 = 'mp4_h265';

    case MP4_AV1 = 'mp4_av1';

    case WEBM_VP9 = 'webm_vp9';

    case HLS_H264 = 'hls_h264';

    case HLS_H265 = 'hls_h265';

    case HLS_AV1 = 'hls_av1';

    case JPG = 'jpg';
}
