<?php

declare(strict_types=1);

namespace Chunkify\Uploads\Upload;

/**
 * Resolved transfer mode for this Upload.
 */
enum UploadMode: string
{
    case SINGLE = 'single';

    case MULTIPART = 'multipart';
}
