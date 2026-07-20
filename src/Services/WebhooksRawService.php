<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Contracts\BaseResponse;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\WebhooksRawContract;
use Chunkify\Webhooks\Webhook;
use Chunkify\Webhooks\WebhookCreateParams;
use Chunkify\Webhooks\WebhookCreateParams\Event;
use Chunkify\Webhooks\WebhookListResponse;
use Chunkify\Webhooks\WebhookUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class WebhooksRawService implements WebhooksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new webhook for a project. The webhook will receive notifications for specified events.
     *
     * @param array{
     *   url: string, enabled?: bool, events?: list<Event|value-of<Event>>
     * }|WebhookCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Webhook>
     *
     * @throws APIException
     */
    public function create(
        array|WebhookCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = WebhookCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/webhooks',
            body: (object) $parsed,
            unwrap: 'data',
            options: $options,
            convert: Webhook::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve details of a specific webhook configuration by its ID. The webhook must belong to the current project.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/webhooks/%1$s', $webhookID],
            unwrap: 'data',
            options: $requestOptions,
            convert: Webhook::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Update the enabled status of a webhook. The webhook must belong to the current project.
     *
     * @param string $webhookID Webhook ID
     * @param array{
     *   enabled?: bool,
     *   events?: list<WebhookUpdateParams\Event|value-of<WebhookUpdateParams\Event>>,
     * }|WebhookUpdateParams $params
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
    ): BaseResponse {
        [$parsed, $options] = WebhookUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['api/webhooks/%1$s', $webhookID],
            body: (object) $parsed,
            options: $options,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Retrieve a list of all webhooks configured for the current project. Each webhook includes its URL, enabled status, and subscribed events.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<WebhookListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/webhooks',
            options: $requestOptions,
            convert: WebhookListResponse::class,
            security: ['projectAccessToken' => true],
        );
    }

    /**
     * @api
     *
     * Permanently delete a webhook configuration. The webhook must belong to the current project. This action cannot be undone.
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
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/webhooks/%1$s', $webhookID],
            options: $requestOptions,
            convert: null,
            security: ['projectAccessToken' => true],
        );
    }
}
