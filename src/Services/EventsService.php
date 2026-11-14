<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Events\Event;
use Chunkify\Events\EventListParams\Created;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\EventsContract;
use Chunkify\Webhooks\WebhookEvent;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Events\EventListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class EventsService implements EventsContract
{
    /**
     * @api
     */
    public EventsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EventsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a retained event, its frozen payload, related resources, and up to 100 delivery attempts. No webhook configuration is required.
     *
     * @param string $eventID event ID to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): Event {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($eventID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List lifecycle events recorded with or without webhooks. Events and their deliveries expire according to the plan retention deadline. Historical notifications recorded before the event log remain available through Notifications.
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
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'created' => $created,
                'events' => $events,
                'limit' => $limit,
                'objectID' => $objectID,
                'offset' => $offset,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
