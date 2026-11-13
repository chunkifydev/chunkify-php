<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\NotificationPayloadTranscoding\Event;

/**
 * Notification for transcoding.created, transcoding.ready, transcoding.failed, transcoding.cancelled, transcoding.expired and transcoding.deleted.
 *
 * @phpstan-import-type NotificationPayloadTranscodingDataShape from \Chunkify\Webhooks\NotificationPayloadTranscodingData
 *
 * @phpstan-type NotificationPayloadTranscodingShape = array{
 *   id: string,
 *   data: NotificationPayloadTranscodingData|NotificationPayloadTranscodingDataShape,
 *   date: \DateTimeInterface,
 *   event: Event|value-of<Event>,
 * }
 */
final class NotificationPayloadTranscoding implements BaseModel
{
    /** @use SdkModel<NotificationPayloadTranscodingShape> */
    use SdkModel;

    /**
     * Unique identifier of the notification.
     */
    #[Required]
    public string $id;

    /**
     * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
     */
    #[Required]
    public NotificationPayloadTranscodingData $data;

    /**
     * Timestamp of the event payload.
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
     * `new NotificationPayloadTranscoding()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadTranscoding::with(id: ..., data: ..., date: ..., event: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadTranscoding)
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
     * @param NotificationPayloadTranscodingData|NotificationPayloadTranscodingDataShape $data
     * @param Event|value-of<Event> $event
     */
    public static function with(
        string $id,
        NotificationPayloadTranscodingData|array $data,
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
     * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
     *
     * @param NotificationPayloadTranscodingData|NotificationPayloadTranscodingDataShape $data
     */
    public function withData(
        NotificationPayloadTranscodingData|array $data
    ): self {
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
     * @param Event|value-of<Event> $event
     */
    public function withEvent(Event|string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }
}
