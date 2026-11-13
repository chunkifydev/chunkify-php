<?php

declare(strict_types=1);

namespace Chunkify\Assets;

/**
 * The action performed: create a static rendition, generate an original transcript or captions, translate a caption, or generate thumbnails.
 */
enum AssetActionType: string
{
    case CREATE_STATIC_RENDITION = 'create_static_rendition';

    case CREATE_CAPTION = 'create_caption';

    case CREATE_TRANSCRIPT = 'create_transcript';

    case TRANSLATE_CAPTION = 'translate_caption';

    case CREATE_THUMBNAILS = 'create_thumbnails';
}
