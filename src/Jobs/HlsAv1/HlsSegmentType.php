<?php

declare(strict_types=1);

namespace Chunkify\Jobs\HlsAv1;

/**
 * HlsSegmentType specifies the type of HLS segments. Valid values:
 * - mpegts: Traditional MPEG-TS segments, better compatibility
 * - fmp4: Fragmented MP4 segments, better efficiency
 */
enum HlsSegmentType: string
{
    case MPEGTS = 'mpegts';

    case FMP4 = 'fmp4';
}
