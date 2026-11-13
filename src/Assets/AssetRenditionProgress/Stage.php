<?php

declare(strict_types=1);

namespace Chunkify\Assets\AssetRenditionProgress;

/**
 * Stage specifies the current preparation activity. Finalization and streaming publication can overlap encoding; finalizing is shown once encoding has completed.
 */
enum Stage: string
{
    case QUEUED = 'queued';

    case STARTING = 'starting';

    case ENCODING = 'encoding';

    case FINALIZING = 'finalizing';

    case UPLOADING = 'uploading';
}
