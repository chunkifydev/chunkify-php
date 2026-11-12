<?php

declare(strict_types=1);

namespace Chunkify\Assets\Asset\Error;

/**
 * Processing stage that failed.
 */
enum Stage: string
{
    case INGEST = 'ingest';

    case ANALYSIS = 'analysis';

    case ENCODING = 'encoding';

    case PACKAGING = 'packaging';

    case UPLOAD = 'upload';

    case VALIDATION = 'validation';

    case CLEANUP = 'cleanup';
}
