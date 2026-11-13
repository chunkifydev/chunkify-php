<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\Actions\AssetActionRun\Input;

/**
 * Resolution specifies the H.264 MP4 output resolution. highest selects the largest supported output without upscaling.
 * Hobby supports up to 1080p; other plans support up to 2160p. Streaming resolution limits do not apply.
 */
enum Resolution: string
{
    case HIGHEST = 'highest';

    case _240P = '240p';

    case _360P = '360p';

    case _480P = '480p';

    case _540P = '540p';

    case _720P = '720p';

    case _1080P = '1080p';

    case _1440P = '1440p';

    case _2160P = '2160p';
}
