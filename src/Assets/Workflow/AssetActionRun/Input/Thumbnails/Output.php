<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\AssetActionRun\Input\Thumbnails;

/**
 * Output selects images or sprites. Defaults to images.
 */
enum Output: string
{
    case IMAGES = 'images';

    case SPRITES = 'sprites';
}
