<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowThumbnailActionParams\Params;

/**
 * Output selects images or sprites. Defaults to images.
 */
enum Output: string
{
    case IMAGES = 'images';

    case SPRITES = 'sprites';
}
