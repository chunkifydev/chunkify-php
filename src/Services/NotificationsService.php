<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Notifications\Notification;
use Chunkify\Notifications\NotificationCreateParams\Event;
use Chunkify\Notifications\NotificationListParams\Created;
use Chunkify\Notifications\NotificationListParams\ResponseStatusCode;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\NotificationsContract;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Notifications\NotificationListParams\Created
 * @phpstan-import-type ResponseStatusCodeShape from \Chunkify\Notifications\NotificationListParams\ResponseStatusCode
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class NotificationsService implements NotificationsContract
{
    /**
     * @api
     */
    public NotificationsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new NotificationsRawService($client);
    }

    /**
     * @api
     *
     * Create a new notification for a job event
     *
     * @param Event|value-of<Event> $event event specifies the type of event that triggered the notification
     * @param string $objectID objectId specifies the object that triggered this notification
     * @param string $webhookID webhookId specifies the webhook endpoint that will receive the notification
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Event|string $event,
        string $objectID,
        string $webhookID,
        RequestOptions|array|null $requestOptions = null,
    ): Notification {
        $params = Util::removeNulls(
            ['event' => $event, 'objectID' => $objectID, 'webhookID' => $webhookID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific notification
     *
     * @param string $notificationID Notification ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $notificationID,
        RequestOptions|array|null $requestOptions = null
    ): Notification {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($notificationID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of notifications with optional filtering and pagination
     *
     * @param Created|CreatedShape $created
     * @param list<\Chunkify\Notifications\NotificationListParams\Event|value-of<\Chunkify\Notifications\NotificationListParams\Event>> $events Filter by events
     * @param int $limit Pagination limit (max 100)
     * @param string $objectID Filter by object ID
     * @param int $offset Pagination offset
     * @param ResponseStatusCode|ResponseStatusCodeShape $responseStatusCode
     * @param string $webhookID Filter by webhook ID
     * @param RequestOpts|null $requestOptions
     *
     * @return PaginatedResults<Notification>
     *
     * @throws APIException
     */
    public function list(
        Created|array|null $created = null,
        ?array $events = null,
        int $limit = 100,
        ?string $objectID = null,
        int $offset = 0,
        ResponseStatusCode|array|null $responseStatusCode = null,
        ?string $webhookID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PaginatedResults {
        $params = Util::removeNulls(
            [
                'created' => $created,
                'events' => $events,
                'limit' => $limit,
                'objectID' => $objectID,
                'offset' => $offset,
                'responseStatusCode' => $responseStatusCode,
                'webhookID' => $webhookID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a notification.
     *
     * @param string $notificationID Notification id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $notificationID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($notificationID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
