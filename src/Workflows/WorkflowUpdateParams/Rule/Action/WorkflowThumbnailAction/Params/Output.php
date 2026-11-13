<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowThumbnailAction\Params;

/**
 * Output selects images or sprites. Defaults to images.
 */
enum Output: string
{
    case IMAGES = 'images';

    case SPRITES = 'sprites';
}
