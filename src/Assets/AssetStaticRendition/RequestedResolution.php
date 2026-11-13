<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetStaticRendition;

/**
 * Requested resolution selector.
 */
enum RequestedResolution: string
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
