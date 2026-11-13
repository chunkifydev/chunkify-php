<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowThumbnailAction\Params;

/**
 * Format selects JPEG or WebP. Defaults to JPEG.
 */
enum Format: string
{
    case JPEG = 'jpeg';

    case WEBP = 'webp';
}
