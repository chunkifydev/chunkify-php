<?php

declare(strict_types=1);

namespace Chunkify\ServiceContracts;

use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Exceptions\WebhookException;
use Chunkify\RequestOptions;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAsset;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetOutput;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetOutputDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadSourceCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadSourceDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadThumbnail;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadTranscoding;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadWorkflowRun;
use Chunkify\Webhooks\Webhook;
use Chunkify\Webhooks\WebhookCreateParams\Event;
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
     * @param list<Event|value-of<Event>> $events events specifies the types of events that will trigger the webhook
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
     * @param list<\Chunkify\Webhooks\WebhookUpdateParams\Event|value-of<\Chunkify\Webhooks\WebhookUpdateParams\Event>> $events events specifies the types of events that will trigger the webhook
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
