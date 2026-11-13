<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\NotificationPayloadAssetOutput\Event;

/**
 * Notification for asset.output.created, asset.output.ready and asset.output.failed.
 *
 * @phpstan-import-type NotificationPayloadAssetOutputDataShape from \Chunkify\Webhooks\NotificationPayloadAssetOutputData
 *
 * @phpstan-type NotificationPayloadAssetOutputShape = array{
 *   id: string,
 *   data: NotificationPayloadAssetOutputData|NotificationPayloadAssetOutputDataShape,
 *   date: \DateTimeInterface,
 *   event: Event|value-of<Event>,
 * }
 */
final class NotificationPayloadAssetOutput implements BaseModel
{
    /** @use SdkModel<NotificationPayloadAssetOutputShape> */
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
    public NotificationPayloadAssetOutputData $data;

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
     * `new NotificationPayloadAssetOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadAssetOutput::with(id: ..., data: ..., date: ..., event: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadAssetOutput)
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
     * @param NotificationPayloadAssetOutputData|NotificationPayloadAssetOutputDataShape $data
     * @param Event|value-of<Event> $event
     */
    public static function with(
        string $id,
        NotificationPayloadAssetOutputData|array $data,
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
     * @param NotificationPayloadAssetOutputData|NotificationPayloadAssetOutputDataShape $data
     */
    public function withData(
        NotificationPayloadAssetOutputData|array $data
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
