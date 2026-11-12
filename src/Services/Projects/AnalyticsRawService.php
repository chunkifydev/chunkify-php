<?php

declare(strict_types=1);

namespace Chunkify\Services\Projects;

use Chunkify\Client;
use Chunkify\ServiceContracts\Projects\AnalyticsRawContract;

final class AnalyticsRawService implements AnalyticsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
