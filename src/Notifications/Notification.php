<?php

declare(strict_types=1);

namespace Chunkify\Notifications;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Notifications\Notification\Event;
use Chunkify\Webhooks\Webhook;

/**
 * @phpstan-import-type WebhookShape from \Chunkify\Webhooks\Webhook
 *
 * @phpstan-type NotificationShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   event: Event|value-of<Event>,
 *   objectID: string,
 *   payload: string,
 *   webhook: Webhook|WebhookShape,
 *   responseStatusCode?: int|null,
 * }
 */
final class Notification implements BaseModel
{
    /** @use SdkModel<NotificationShape> */
    use SdkModel;

    /**
     * Unique identifier of the notification.
     */
    #[Required]
    public string $id;

    /**
     * Timestamp when the notification was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Type of event that triggered this notification.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * ID of the object that triggered this notification.
     */
    #[Required('object_id')]
    public string $objectID;

    /**
     * JSON payload that was sent to the webhook endpoint.
     */
    #[Required]
    public string $payload;

    /**
     * Webhook endpoint configuration that received this notification.
     */
    #[Required]
    public Webhook $webhook;

    /**
     * HTTP status code received from the webhook endpoint.
     */
    #[Optional('response_status_code')]
    public ?int $responseStatusCode;

    /**
     * `new Notification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Notification::with(
     *   id: ..., createdAt: ..., event: ..., objectID: ..., payload: ..., webhook: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Notification)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withEvent(...)
     *   ->withObjectID(...)
     *   ->withPayload(...)
     *   ->withWebhook(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Event|value-of<Event> $event
     * @param Webhook|WebhookShape $webhook
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        Event|string $event,
        string $objectID,
        string $payload,
        Webhook|array $webhook,
        ?int $responseStatusCode = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['event'] = $event;
        $self['objectID'] = $objectID;
        $self['payload'] = $payload;
        $self['webhook'] = $webhook;

        null !== $responseStatusCode && $self['responseStatusCode'] = $responseStatusCode;

        return $self;
    }

    /**
     * Unique identifier of the notification.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Timestamp when the notification was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Type of event that triggered this notification.
     *
     * @param Event|value-of<Event> $event
     */
    public function withEvent(Event|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * ID of the object that triggered this notification.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * JSON payload that was sent to the webhook endpoint.
     */
    public function withPayload(string $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }

    /**
     * Webhook endpoint configuration that received this notification.
     *
     * @param Webhook|WebhookShape $webhook
     */
    public function withWebhook(Webhook|array $webhook): self
    {
        $self = clone $this;
        $self['webhook'] = $webhook;

        return $self;
    }

    /**
     * HTTP status code received from the webhook endpoint.
     */
    public function withResponseStatusCode(int $responseStatusCode): self
    {
        $self = clone $this;
        $self['responseStatusCode'] = $responseStatusCode;

        return $self;
    }
}
