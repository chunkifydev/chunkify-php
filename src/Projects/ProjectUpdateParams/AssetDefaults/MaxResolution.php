<?php

declare(strict_types=1);

namespace Chunkify\Projects\ProjectUpdateParams\AssetDefaults;

/**
 * Maximum streaming resolution. Defaults to 1080p on Hobby and 2160p on other plans. 2160p requires Starter or above. Smaller sources are not upscaled. Does not affect static renditions.
 */
enum MaxResolution: string
{
    case _1080P = '1080p';

    case _2160P = '2160p';
}
