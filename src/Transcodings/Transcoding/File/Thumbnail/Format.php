<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\Transcoding\File\Thumbnail;

/**
 * Format specifies the image encoding.
 */
enum Format: string
{
    case JPEG = 'jpeg';

    case WEBP = 'webp';
}
