<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail\Settings;

/**
 * Output specifies the accepted output mode.
 */
enum Output: string
{
    case IMAGES = 'images';

    case SPRITES = 'sprites';
}
