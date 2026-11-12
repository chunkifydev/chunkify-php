<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\Transcoding;

/**
 * ProcessingStage specifies the current activity while the status is preparing. Omitted otherwise.
 */
enum ProcessingStage: string
{
    case QUEUED = 'queued';

    case STARTING = 'starting';

    case ENCODING = 'encoding';

    case FINALIZING = 'finalizing';

    case UPLOADING = 'uploading';
}
