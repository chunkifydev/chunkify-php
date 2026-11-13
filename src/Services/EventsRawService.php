<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Events\Event;
use Chunkify\Events\EventListParams;
use Chunkify\Events\EventListParams\Created;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\EventsRawContract;
use Chunkify\Webhooks\WebhookEvent;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Events\EventListParams\Created
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class EventsRawService implements EventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a retained event, its frozen payload, related resources, and up to 100 delivery attempts. No webhook configuration is required.
     *
     * @param string $eventID event ID to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Event>
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['events/%1$s', $eventID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Event::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * List lifecycle events recorded with or without webhooks. Events and their deliveries expire according to the plan retention deadline. Historical notifications recorded before the event log remain available through Notifications.
     *
     * @param array{
     *   created?: Created|CreatedShape,
     *   events?: list<WebhookEvent|value-of<WebhookEvent>>,
     *   limit?: int,
     *   objectID?: string,
     *   offset?: int,
     * }|EventListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Event>>
     *
     * @throws APIException
     */
    public function list(
        array|EventListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'events',
            query: Util::array_transform_keys($parsed, ['objectID' => 'object_id']),
            options: $options,
            convert: Event::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }
}
