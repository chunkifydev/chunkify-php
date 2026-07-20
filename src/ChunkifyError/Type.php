<?php

declare(strict_types=1);

namespace Chunkify\ChunkifyError;

/**
 * Type of error.
 */
enum Type: string
{
    case SETUP = 'setup';

    case FFMPEG = 'ffmpeg';

    case SOURCE = 'source';

    case UPLOAD = 'upload';

    case DOWNLOAD = 'download';

    case INGEST = 'ingest';

    case JOB = 'job';

    case UNEXPECTED = 'unexpected';

    case PERMISSION = 'permission';

    case TIMEOUT = 'timeout';

    case CANCELLED = 'cancelled';
}
