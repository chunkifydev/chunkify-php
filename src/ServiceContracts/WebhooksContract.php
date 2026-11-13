<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Exceptions\WebhookException;
use Chunkify\RequestOptions;
use Chunkify\Webhooks\NotificationPayloadAsset;
use Chunkify\Webhooks\NotificationPayloadAssetDeleted;
use Chunkify\Webhooks\NotificationPayloadAssetOutput;
use Chunkify\Webhooks\NotificationPayloadAssetOutputDeleted;
use Chunkify\Webhooks\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\NotificationPayloadJobCreated;
use Chunkify\Webhooks\NotificationPayloadJobFailed;
use Chunkify\Webhooks\NotificationPayloadSourceCreated;
use Chunkify\Webhooks\NotificationPayloadSourceDeleted;
use Chunkify\Webhooks\NotificationPayloadThumbnail;
use Chunkify\Webhooks\NotificationPayloadTranscoding;
use Chunkify\Webhooks\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\NotificationPayloadUploadCreated;
use Chunkify\Webhooks\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\NotificationPayloadWorkflowRun;
use Chunkify\Webhooks\Webhook;
use Chunkify\Webhooks\WebhookEvent;
use Chunkify\Webhooks\WebhookListResponse;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
interface WebhooksContract
{
    /**
     * @api
     *
     * @param string $url url is the endpoint that will receive webhook notifications, which must be a valid HTTP URL
     * @param bool $enabled enabled indicates whether the webhook is active
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events events specifies the types of events that will trigger the webhook
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $url,
        ?bool $enabled = null,
        ?array $events = null,
        RequestOptions|array|null $requestOptions = null,
    ): Webhook;

    /**
     * @api
     *
     * @param string $webhookID Webhook ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): Webhook;

    /**
     * @api
     *
     * @param string $webhookID Webhook ID
     * @param bool $enabled enabled indicates whether the webhook should be enabled or disabled
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events events specifies the types of events that will trigger the webhook
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $webhookID,
        ?bool $enabled = null,
        ?array $events = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): WebhookListResponse;

    /**
     * @api
     *
     * @param string $webhookID Webhook ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * Unwraps a webhook event from its JSON representation.
     *
     * @param array<string,string|list<string>>|null $headers
     *
     * @throws WebhookException
     */
    public function unwrap(
        string $body,
        ?array $headers = null,
        ?string $secret = null
    ): NotificationPayloadJobCompleted|NotificationPayloadJobFailed|NotificationPayloadJobCreated|NotificationPayloadSourceCreated|NotificationPayloadSourceDeleted|NotificationPayloadUploadCreated|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed|NotificationPayloadAsset|NotificationPayloadAssetOutput|NotificationPayloadAssetOutputDeleted|NotificationPayloadAssetDeleted|NotificationPayloadWorkflowRun|NotificationPayloadTranscoding|NotificationPayloadThumbnail;
}
