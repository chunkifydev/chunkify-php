<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job;

/**
 * Current status of the job.
 */
enum Status: string
{
    case QUEUED = 'queued';

    case INGESTING = 'ingesting';

    case TRANSCODING = 'transcoding';

    case DOWNLOADING = 'downloading';

    case MERGING = 'merging';

    case UPLOADING = 'uploading';

    case FAILED = 'failed';

    case COMPLETED = 'completed';

    case CANCELLED = 'cancelled';

    case MERGED = 'merged';

    case DOWNLOADED = 'downloaded';

    case TRANSCODED = 'transcoded';

    case WAITING = 'waiting';
}
