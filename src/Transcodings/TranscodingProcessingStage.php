<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

/**
 * ProcessingStage specifies the current preparation activity. queued means the request is waiting for processing capacity.
 */
enum TranscodingProcessingStage: string
{
    case QUEUED = 'queued';

    case STARTING = 'starting';

    case ENCODING = 'encoding';

    case FINALIZING = 'finalizing';

    case UPLOADING = 'uploading';
}
