<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail\File;

/**
 * Kind identifies an individual image, sprite sheet, or WebVTT index.
 */
enum Kind: string
{
    case IMAGE = 'image';

    case SPRITE = 'sprite';

    case VTT = 'vtt';
}
