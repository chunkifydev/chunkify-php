<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetCreateParams;

/**
 * Maximum streaming resolution. Omit to use the Project default, or the plan maximum if unset. 2160p requires Starter or above. Smaller sources are not upscaled. Does not affect static renditions.
 */
enum MaxResolution: string
{
    case _1080P = '1080p';

    case _2160P = '2160p';
}
