<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

/**
 * Output specifies individual images or automatically arranged sprite sheets.
 */
enum ThumbnailOutput: string
{
    case IMAGES = 'images';

    case SPRITES = 'sprites';
}
