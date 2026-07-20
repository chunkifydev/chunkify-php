<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Transcoders\TranscoderListResponse\Data;

/**
 * Current status of the transcoder (starting, transcoding, finished, failed).
 */
enum Status: string
{
    case STARTING = 'starting';

    case PENDING = 'pending';

    case TRANSCODING = 'transcoding';

    case COMPLETED = 'completed';

    case FAILED = 'failed';

    case CANCELLED = 'cancelled';
}
