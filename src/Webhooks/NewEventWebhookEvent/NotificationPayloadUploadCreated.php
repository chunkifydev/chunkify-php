<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadCreated\Data;

/**
 * Notification for upload.created.
 *
 * @phpstan-import-type DataShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadCreated\Data
 *
 * @phpstan-type NotificationPayloadUploadCreatedShape = array{
 *   id: string,
 *   data: Data|DataShape,
 *   date: \DateTimeInterface,
 *   event: 'upload.created',
 * }
 */
final class NotificationPayloadUploadCreated implements BaseModel
{
    /** @use SdkModel<NotificationPayloadUploadCreatedShape> */
    use SdkModel;

    /**
     * Type of event that triggered the notification.
     *
     * @var 'upload.created' $event
     */
    #[Required]
    public string $event = 'upload.created';

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
     * `new NotificationPayloadUploadCreated()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadUploadCreated::with(id: ..., data: ..., date: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadUploadCreated)
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
     * @param 'upload.created' $event
     */
    public function withEvent(string $event): self
    {
        $self = clone $this;
        $self['event'] = $event;

        return $self;
    }
}
