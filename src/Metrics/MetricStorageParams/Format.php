<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricStorageParams;

/**
 * Response format. Defaults to JSON unless Accept requests CSV. Overrides Accept when supplied; errors remain JSON.
 */
enum Format: string
{
    case JSON = 'json';

    case CSV = 'csv';
}
