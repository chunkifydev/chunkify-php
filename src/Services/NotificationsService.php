<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Notifications\Notification;
use Chunkify\Notifications\NotificationListParams\Created;
use Chunkify\Notifications\NotificationListParams\ResponseStatusCode;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\NotificationsContract;
use Chunkify\Webhooks\WebhookEvent;

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
     * Send an event notification to a webhook endpoint. Recorded events replay their original payload.
     *
     * @param WebhookEvent|value-of<WebhookEvent> $event event specifies the type of event that triggered the notification
     * @param string $objectID ID of the resource that triggered the event. Use the caption, static rendition, or thumbnail ID for their Asset child events. Replaying asset events, job.created, or source.created requires a retained snapshot. Resource deletion does not prevent replay.
     * @param string $webhookID webhookId specifies the webhook endpoint that will receive the notification
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        WebhookEvent|string $event,
        string $objectID,
        string $webhookID,
        RequestOptions|array|null $requestOptions = null,
    ): Notification {
        $params = [];
        $params['event'] = $event;
        $params['objectID'] = $objectID;
        $params['webhookID'] = $webhookID;

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
     * @param string $eventID filter deliveries by their originating event ID
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events Filter by events
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
        ?string $eventID = null,
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
                'eventID' => $eventID,
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
