<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Notifications\Notification;
use Chunkify\Notifications\NotificationCreateParams;
use Chunkify\Notifications\NotificationListParams;
use Chunkify\PaginatedResults;
use Chunkify\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface NotificationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|NotificationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Notification>
     *
     * @throws APIException
     */
    public function create(
        array|NotificationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|NotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PaginatedResults<Notification>>
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
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
    ): BaseResponse;
}
