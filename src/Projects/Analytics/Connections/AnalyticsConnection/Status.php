<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections\AnalyticsConnection;

/**
 * Status indicates whether the connection is ready to read or requires setup repair.
 */
enum Status: string
{
    case PREPARING = 'preparing';

    case READY = 'ready';

    case FAILED = 'failed';
}
