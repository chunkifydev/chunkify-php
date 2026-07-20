<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\Event;

/**
 * @phpstan-import-type DataVariants from \Chunkify\Webhooks\UnwrapWebhookEvent\Data
 * @phpstan-import-type DataShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data
 *
 * @phpstan-type UnwrapWebhookEventShape = array{
 *   id: string,
 *   data: DataShape,
 *   date: \DateTimeInterface,
 *   event: Event|value-of<Event>,
 * }
 */
final class UnwrapWebhookEvent implements BaseModel
{
    /** @use SdkModel<UnwrapWebhookEventShape> */
    use SdkModel;

    /**
     * Unique identifier of the notification.
     */
    #[Required]
    public string $id;

    /**
     * Event-specific payload data.
     *
     * @var DataVariants $data
     */
    #[Required]
    public NotificationPayloadJobCompleted|NotificationPayloadJobFailed|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed $data;

    /**
     * Timestamp when the notification was sent.
     */
    #[Required]
    public \DateTimeInterface $date;

    /**
     * Type of event that triggered the notification.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * `new UnwrapWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnwrapWebhookEvent::with(id: ..., data: ..., date: ..., event: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnwrapWebhookEvent)
     *   ->withID(...)
     *   ->withData(...)
     *   ->withDate(...)
     *   ->withEvent(...)
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
     * @param DataShape $data
     * @param Event|value-of<Event> $event
     */
    public static function with(
        string $id,
        NotificationPayloadJobCompleted|array|NotificationPayloadJobFailed|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed $data,
        \DateTimeInterface $date,
        Event|string $event,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['data'] = $data;
        $self['date'] = $date;
        $self['event'] = $event;

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
     * Event-specific payload data.
     *
     * @param DataShape $data
     */
    public function withData(
        NotificationPayloadJobCompleted|array|NotificationPayloadJobFailed|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed $data,
    ): self {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Timestamp when the notification was sent.
     */
    public function withDate(\DateTimeInterface $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * Type of event that triggered the notification.
     *
     * @param Event|value-of<Event> $event
     */
    public function withEvent(Event|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }
}
