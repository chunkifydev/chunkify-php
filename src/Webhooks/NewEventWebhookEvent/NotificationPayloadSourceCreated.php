<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadSourceCreated\Data;

/**
 * Notification for source.created.
 *
 * @phpstan-import-type DataShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadSourceCreated\Data
 *
 * @phpstan-type NotificationPayloadSourceCreatedShape = array{
 *   id: string,
 *   data: Data|DataShape,
 *   date: \DateTimeInterface,
 *   event: 'source.created',
 * }
 */
final class NotificationPayloadSourceCreated implements BaseModel
{
    /** @use SdkModel<NotificationPayloadSourceCreatedShape> */
    use SdkModel;

    /**
     * Type of event that triggered the notification.
     *
     * @var 'source.created' $event
     */
    #[Required]
    public string $event = 'source.created';

    /**
     * Unique identifier of the notification.
     */
    #[Required]
    public string $id;

    /**
     * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
     */
    #[Required]
    public Data $data;

    /**
     * Timestamp of the event payload.
     */
    #[Required]
    public \DateTimeInterface $date;

    /**
     * `new NotificationPayloadSourceCreated()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadSourceCreated::with(id: ..., data: ..., date: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadSourceCreated)
     *   ->withID(...)
     *   ->withData(...)
     *   ->withDate(...)
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
     * @param Data|DataShape $data
     */
    public static function with(
        string $id,
        Data|array $data,
        \DateTimeInterface $date
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['data'] = $data;
        $self['date'] = $date;

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
     * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
     *
     * @param Data|DataShape $data
     */
    public function withData(Data|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Timestamp of the event payload.
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
     * @param 'source.created' $event
     */
    public function withEvent(string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }
}
