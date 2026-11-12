<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails\Thumbnail\Settings;

/**
 * Format specifies the accepted image encoding.
 */
enum Format: string
{
    case JPEG = 'jpeg';

    case WEBP = 'webp';
}
