<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAsset;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetDeleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetOutput;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetOutputDeleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobFailed;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadSourceCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadTranscoding;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadWorkflowRun;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\ThumbnailEventData;
use Chunkify\Webhooks\NewEventWebhookEvent\Event;

/**
 * @phpstan-import-type DataVariants from \Chunkify\Webhooks\NewEventWebhookEvent\Data
 * @phpstan-import-type DataShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data
 *
 * @phpstan-type NewEventWebhookEventShape = array{
 *   id: string,
 *   data: DataShape,
 *   date: \DateTimeInterface,
 *   event: Event|value-of<Event>,
 * }
 */
final class NewEventWebhookEvent implements BaseModel
{
    /** @use SdkModel<NewEventWebhookEventShape> */
    use SdkModel;

    /**
     * Unique identifier of the notification.
     */
    #[Required]
    public string $id;

    /**
     * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
     *
     * @var DataVariants $data
     */
    #[Required]
    public NotificationPayloadJobCompleted|NotificationPayloadJobFailed|NotificationPayloadJobCreated|NotificationPayloadSourceCreated|NotificationPayloadUploadCreated|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed|NotificationPayloadAsset|NotificationPayloadAssetOutput|NotificationPayloadAssetOutputDeleted|NotificationPayloadAssetDeleted|NotificationPayloadWorkflowRun|NotificationPayloadTranscoding|ThumbnailEventData $data;

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
     * `new NewEventWebhookEvent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NewEventWebhookEvent::with(id: ..., data: ..., date: ..., event: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NewEventWebhookEvent)
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
        NotificationPayloadJobCompleted|array|NotificationPayloadJobFailed|NotificationPayloadJobCreated|NotificationPayloadSourceCreated|NotificationPayloadUploadCreated|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed|NotificationPayloadAsset|NotificationPayloadAssetOutput|NotificationPayloadAssetOutputDeleted|NotificationPayloadAssetDeleted|NotificationPayloadWorkflowRun|NotificationPayloadTranscoding|ThumbnailEventData $data,
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
     * @param DataShape $data
     */
    public function withData(
        NotificationPayloadJobCompleted|array|NotificationPayloadJobFailed|NotificationPayloadJobCreated|NotificationPayloadSourceCreated|NotificationPayloadUploadCreated|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed|NotificationPayloadAsset|NotificationPayloadAssetOutput|NotificationPayloadAssetOutputDeleted|NotificationPayloadAssetDeleted|NotificationPayloadWorkflowRun|NotificationPayloadTranscoding|ThumbnailEventData $data,
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
