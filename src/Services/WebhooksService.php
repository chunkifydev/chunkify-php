<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Conversion;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Exceptions\WebhookException;
use Chunkify\Core\Util;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\WebhooksContract;
use Chunkify\Webhooks\UnwrapWebhookEvent;
use Chunkify\Webhooks\WebhookCreateParams\Event;
use Chunkify\Webhooks\WebhookListResponse;
use StandardWebhooks\Exception\WebhookVerificationException;
use StandardWebhooks\Webhook;

/**
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class WebhooksService implements WebhooksContract
{
    /**
     * @api
     */
    public WebhooksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WebhooksRawService($client);
    }

    /**
     * @api
     *
     * Create a new webhook for a project. The webhook will receive notifications for specified events.
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
    ): \Chunkify\Webhooks\Webhook {
        $params = Util::removeNulls(
            ['url' => $url, 'enabled' => $enabled, 'events' => $events]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific webhook configuration by its ID. The webhook must belong to the current project.
     *
     * @param string $webhookID Webhook ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): \Chunkify\Webhooks\Webhook {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update the enabled status of a webhook. The webhook must belong to the current project.
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
    ): mixed {
        $params = Util::removeNulls(['enabled' => $enabled, 'events' => $events]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($webhookID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all webhooks configured for the current project. Each webhook includes its URL, enabled status, and subscribed events.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): WebhookListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Permanently delete a webhook configuration. The webhook must belong to the current project. This action cannot be undone.
     *
     * @param string $webhookID Webhook ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $webhookID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($webhookID, requestOptions: $requestOptions);

        return $response->parse();
    }

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
    ): UnwrapWebhookEvent {
        if (!is_null($headers)) {
            $secret = $secret ?? ($this->client->webhookKey ?: null);
            if (is_null($secret)) {
                throw new WebhookException('Webhook key must not be null in order to unwrap');
            }

            try {
                $flatHeaders = array_map(fn (string|array $v): string => is_array($v) ? $v[0] : $v, $headers);
                $webhook = new Webhook($secret);
                $webhook->verify($body, $flatHeaders);
            } catch (WebhookVerificationException $e) {
                throw new WebhookException('Could not verify webhook event signature', previous: $e);
            }
        }

        try {
            $decoded = Util::decodeJson($body);

            // @phpstan-ignore return.type
            return Conversion::coerce(UnwrapWebhookEvent::class, value: $decoded);
        } catch (\Throwable $e) {
            throw new WebhookException('Error parsing webhook body', previous: $e);
        }
    }
}
