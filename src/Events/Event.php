<?php

declare(strict_types=1);

namespace Chunkify\Events;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Events\Event\DeliveryStatus;
use Chunkify\Notifications\Notification;
use Chunkify\Webhooks\WebhookEvent;

/**
 * A retained lifecycle event, recorded independently of webhook subscriptions. The payload is an immutable JSON snapshot.
 *
 * @phpstan-import-type NotificationShape from \Chunkify\Notifications\Notification
 *
 * @phpstan-type EventShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   deliveryCount: int,
 *   deliveryStatus: DeliveryStatus|value-of<DeliveryStatus>,
 *   event: WebhookEvent|value-of<WebhookEvent>,
 *   expiresAt: \DateTimeInterface,
 *   objectID: string,
 *   payload: string,
 *   relatedObjectIDs: list<string>,
 *   deliveries?: list<Notification|NotificationShape>|null,
 * }
 */
final class Event implements BaseModel
{
    /** @use SdkModel<EventShape> */
    use SdkModel;

    /**
     * Unique event ID.
     */
    #[Required]
    public string $id;

    /**
     * Time the event occurred.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Number of retained webhook delivery attempts.
     */
    #[Required('delivery_count')]
    public int $deliveryCount;

    /**
     * Summary of the latest retained attempt for each webhook. none means no retained attempts; pending means at least one latest attempt is awaiting delivery; failed means at least one latest attempt failed and none are pending; delivered means all latest attempts succeeded. Earlier failures superseded by successful retries do not mark the event failed.
     *
     * @var value-of<DeliveryStatus> $deliveryStatus
     */
    #[Required('delivery_status', enum: DeliveryStatus::class)]
    public string $deliveryStatus;

    /** @var value-of<WebhookEvent> $event */
    #[Required(enum: WebhookEvent::class)]
    public string $event;

    /**
     * Retention deadline set from the project team plan when the event was recorded. Deliveries and retries share this deadline.
     */
    #[Required('expires_at')]
    public \DateTimeInterface $expiresAt;

    /**
     * ID of the resource that caused this event.
     */
    #[Required('object_id')]
    public string $objectID;

    /**
     * Immutable JSON event envelope. Its ID is the event ID; webhook delivery envelopes retain their notification IDs. Signed links in historical snapshots may have expired.
     */
    #[Required]
    public string $payload;

    /**
     * Related resource IDs retained independently of resource deletion.
     *
     * @var list<string> $relatedObjectIDs
     */
    #[Required('related_object_ids', list: 'string')]
    public array $relatedObjectIDs;

    /**
     * First 100 delivery attempts, oldest first; included on retrieval. List notifications with event_id to paginate all attempts.
     *
     * @var list<Notification>|null $deliveries
     */
    #[Optional(list: Notification::class)]
    public ?array $deliveries;

    /**
     * `new Event()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Event::with(
     *   id: ...,
     *   createdAt: ...,
     *   deliveryCount: ...,
     *   deliveryStatus: ...,
     *   event: ...,
     *   expiresAt: ...,
     *   objectID: ...,
     *   payload: ...,
     *   relatedObjectIDs: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Event)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDeliveryCount(...)
     *   ->withDeliveryStatus(...)
     *   ->withEvent(...)
     *   ->withExpiresAt(...)
     *   ->withObjectID(...)
     *   ->withPayload(...)
     *   ->withRelatedObjectIDs(...)
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
     * @param DeliveryStatus|value-of<DeliveryStatus> $deliveryStatus
     * @param WebhookEvent|value-of<WebhookEvent> $event
     * @param list<string> $relatedObjectIDs
     * @param list<Notification|NotificationShape>|null $deliveries
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        int $deliveryCount,
        DeliveryStatus|string $deliveryStatus,
        WebhookEvent|string $event,
        \DateTimeInterface $expiresAt,
        string $objectID,
        string $payload,
        array $relatedObjectIDs,
        ?array $deliveries = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['deliveryCount'] = $deliveryCount;
        $self['deliveryStatus'] = $deliveryStatus;
        $self['event'] = $event;
        $self['expiresAt'] = $expiresAt;
        $self['objectID'] = $objectID;
        $self['payload'] = $payload;
        $self['relatedObjectIDs'] = $relatedObjectIDs;

        null !== $deliveries && $self['deliveries'] = $deliveries;

        return $self;
    }

    /**
     * Unique event ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Time the event occurred.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Number of retained webhook delivery attempts.
     */
    public function withDeliveryCount(int $deliveryCount): self
    {
        $self = clone $this;
        $self['deliveryCount'] = $deliveryCount;

        return $self;
    }

    /**
     * Summary of the latest retained attempt for each webhook. none means no retained attempts; pending means at least one latest attempt is awaiting delivery; failed means at least one latest attempt failed and none are pending; delivered means all latest attempts succeeded. Earlier failures superseded by successful retries do not mark the event failed.
     *
     * @param DeliveryStatus|value-of<DeliveryStatus> $deliveryStatus
     */
    public function withDeliveryStatus(
        DeliveryStatus|string $deliveryStatus
    ): self {
        $self = clone $this;
        $self['deliveryStatus'] = $deliveryStatus;

        return $self;
    }

    /**
     * @param WebhookEvent|value-of<WebhookEvent> $event
     */
    public function withEvent(WebhookEvent|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }

    /**
     * Retention deadline set from the project team plan when the event was recorded. Deliveries and retries share this deadline.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * ID of the resource that caused this event.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Immutable JSON event envelope. Its ID is the event ID; webhook delivery envelopes retain their notification IDs. Signed links in historical snapshots may have expired.
     */
    public function withPayload(string $payload): self
    {
        $self = clone $this;
        $self['payload'] = $payload;

        return $self;
    }

    /**
     * Related resource IDs retained independently of resource deletion.
     *
     * @param list<string> $relatedObjectIDs
     */
    public function withRelatedObjectIDs(array $relatedObjectIDs): self
    {
        $self = clone $this;
        $self['relatedObjectIDs'] = $relatedObjectIDs;

        return $self;
    }

    /**
     * First 100 delivery attempts, oldest first; included on retrieval. List notifications with event_id to paginate all attempts.
     *
     * @param list<Notification|NotificationShape> $deliveries
     */
    public function withDeliveries(array $deliveries): self
    {
        $self = clone $this;
        $self['deliveries'] = $deliveries;

        return $self;
    }
}
