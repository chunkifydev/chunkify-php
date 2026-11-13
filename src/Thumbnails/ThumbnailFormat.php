<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

/**
 * Format specifies the image encoding.
 */
enum ThumbnailFormat: string
{
    case JPEG = 'jpeg';

    case WEBP = 'webp';
}
