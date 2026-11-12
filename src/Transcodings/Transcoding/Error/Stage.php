<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\Transcoding\Error;

/**
 * Stage identifies where processing failed.
 */
enum Stage: string
{
    case QUEUED = 'queued';

    case STARTING = 'starting';

    case ENCODING = 'encoding';

    case FINALIZING = 'finalizing';

    case UPLOADING = 'uploading';
}
