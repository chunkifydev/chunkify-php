<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowThumbnailParams;

/**
 * Output selects images or sprites. Defaults to images.
 */
enum Output: string
{
    case IMAGES = 'images';

    case SPRITES = 'sprites';
}
