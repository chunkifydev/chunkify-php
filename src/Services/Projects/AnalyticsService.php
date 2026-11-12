<?php

declare(strict_types=1);

namespace Chunkify\Services\Projects;

use Chunkify\Client;
use Chunkify\ServiceContracts\Projects\AnalyticsContract;
use Chunkify\Services\Projects\Analytics\ConnectionsService;

final class AnalyticsService implements AnalyticsContract
{
    /**
     * @api
     */
    public AnalyticsRawService $raw;

    /**
     * @api
     */
    public ConnectionsService $connections;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AnalyticsRawService($client);
        $this->connections = new ConnectionsService($client);
    }
}
