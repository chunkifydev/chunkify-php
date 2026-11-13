<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\Actions\AssetActionRun\Input\Thumbnails;

/**
 * Format selects JPEG or WebP. Defaults to JPEG.
 */
enum Format: string
{
    case JPEG = 'jpeg';

    case WEBP = 'webp';
}
