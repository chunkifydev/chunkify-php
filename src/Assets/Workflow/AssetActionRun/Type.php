<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\AssetActionRun;

/**
 * Type of action performed.
 */
enum Type: string
{
    case CREATE_STATIC_RENDITION = 'create_static_rendition';

    case CREATE_CAPTION = 'create_caption';

    case CREATE_TRANSCRIPT = 'create_transcript';

    case TRANSLATE_CAPTION = 'translate_caption';

    case CREATE_THUMBNAILS = 'create_thumbnails';
}
