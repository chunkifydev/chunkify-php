<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections\AnalyticsConnection;

/**
 * Type specifies whether Chunkify manages the analytics project.
 */
enum Type: string
{
    case HOSTED = 'hosted';

    case CUSTOM = 'custom';
}
