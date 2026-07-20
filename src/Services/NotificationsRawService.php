<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Util;
use Chunkify\Notifications\Notification;
use Chunkify\Notifications\NotificationCreateParams;
use Chunkify\Notifications\NotificationCreateParams\Event;
use Chunkify\Notifications\NotificationListParams;
use Chunkify\Notifications\NotificationListParams\Created;
use Chunkify\Notifications\NotificationListParams\ResponseStatusCode;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\NotificationsRawContract;

/**
 * @phpstan-import-type CreatedShape from \Chunkify\Notifications\NotificationListParams\Created
 * @phpstan-import-type ResponseStatusCodeShape from \Chunkify\Notifications\NotificationListParams\ResponseStatusCode
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class NotificationsRawService implements NotificationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new notification for a job event
     *
     * @param array{
     *   event: value-of<Event>, objectID: string, webhookID: string
     * }|NotificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Notification>
     *
     * @throws APIException
     */
    public function create(
        array|NotificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/notifications',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Notification::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve details of a specific notification
     *
     * @param string $notificationID Notification ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Notification>
     *
     * @throws APIException
     */
    public function retrieve(
        string $notificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/notifications/%1$s', $notificationID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Notification::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of notifications with optional filtering and pagination
     *
     * @param array{
     *   created?: Created|CreatedShape,
     *   events?: list<NotificationListParams\Event|value-of<NotificationListParams\Event>>,
     *   limit?: int,
     *   objectID?: string,
     *   offset?: int,
     *   responseStatusCode?: ResponseStatusCode|ResponseStatusCodeShape,
     *   webhookID?: string,
     * }|NotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Notification>>
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/notifications',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'objectID' => 'object_id',
                    'responseStatusCode' => 'response_status_code',
                    'webhookID' => 'webhook_id',
                ],
            ),
            options: $options,
            convert: Notification::class,
            page: PaginatedResults::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Delete a notification.
     *
     * @param string $notificationID Notification id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $notificationID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/notifications/%1$s', $notificationID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
