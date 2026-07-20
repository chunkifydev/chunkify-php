<?php

declare(strict_types=1);

namespace Chunkify\Uploads\Upload;

/**
 * Current status of the upload.
 */
enum Status: string
{
    case WAITING = 'waiting';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case EXPIRED = 'expired';
}
