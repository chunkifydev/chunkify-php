<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\Webhooks\Webhook;
use Chunkify\Webhooks\WebhookCreateParams;
use Chunkify\Webhooks\WebhookListResponse;
use Chunkify\Webhooks\WebhookUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface WebhooksRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $webhookID Webhook ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $webhookID Webhook ID
     * @param array<string,mixed>|WebhookUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        array|WebhookUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $webhookID Webhook ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
