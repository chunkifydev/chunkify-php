<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\Actions\AssetActionRun\Result;

/**
 * Type of output referenced by output_id. Caption generation and translation both produce caption outputs.
 */
enum OutputType: string
{
    case CAPTION = 'caption';

    case STATIC_RENDITION = 'static_rendition';

    case THUMBNAIL = 'thumbnail';

    case TRANSCRIPT = 'transcript';
}
