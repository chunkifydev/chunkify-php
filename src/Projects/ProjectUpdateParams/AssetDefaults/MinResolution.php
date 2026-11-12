<?php

declare(strict_types=1);

namespace Chunkify\Projects\ProjectUpdateParams\AssetDefaults;

/**
 * Minimum streaming resolution. Defaults to auto, with no minimum. Must not exceed max_resolution. Smaller sources are not upscaled. Does not affect static renditions.
 */
enum MinResolution: string
{
    case AUTO = 'auto';

    case _240P = '240p';

    case _360P = '360p';

    case _540P = '540p';

    case _720P = '720p';

    case _1080P = '1080p';

    case _1440P = '1440p';

    case _2160P = '2160p';
}
