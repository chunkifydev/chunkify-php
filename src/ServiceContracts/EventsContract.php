<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Events\Event;
use Chunkify\Events\EventListParams\Created;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\Webhooks\WebhookEvent;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Events\EventListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface EventsContract
{
    /**
     * @api
     *
     * @param string $eventID event ID to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): Event;

    /**
     * @api
     *
     * @param Created|CreatedShape $created
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events Filter by events
     * @param int $limit Pagination limit (max 100)
     * @param string $objectID filter by the primary or a related resource ID, including retained associations after resource deletion
     * @param int $offset Pagination offset
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Event>
     *
     * @throws APIException
     */
    public function list(
        Created|array|null $created = null,
        ?array $events = null,
        int $limit = 100,
        ?string $objectID = null,
        int $offset = 0,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults;
}
