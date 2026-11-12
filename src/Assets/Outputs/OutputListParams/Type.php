<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputListParams;

/**
 * Type specifies the output kind to include. Omit it to include all kinds.
 */
enum Type: string
{
    case CAPTION = 'caption';

    case TRANSCRIPT = 'transcript';

    case STATIC_RENDITION = 'static_rendition';

    case THUMBNAIL = 'thumbnail';
}
