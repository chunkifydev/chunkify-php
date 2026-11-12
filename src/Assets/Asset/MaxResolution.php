<?php

declare(strict_types=1);

namespace Chunkify\Assets\Asset;

/**
 * Maximum streaming resolution selected at creation. Does not limit static renditions.
 */
enum MaxResolution: string
{
    case _1080P = '1080p';

    case _2160P = '2160p';
}
