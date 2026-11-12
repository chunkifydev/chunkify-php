<?php

declare(strict_types=1);

namespace Chunkify\Notifications;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Notifications\NotificationCreateParams\Event;

/**
 * Send an event notification to a webhook endpoint. Recorded events replay their original payload.
 *
 * @see Chunkify\Services\NotificationsService::create()
 *
 * @phpstan-type NotificationCreateParamsShape = array{
 *   event: Event|value-of<Event>, objectID: string, webhookID: string
 * }
 */
final class NotificationCreateParams implements BaseModel
{
    /** @use SdkModel<NotificationCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Event specifies the type of event that triggered the notification.
     *
     * @var value-of<Event> $event
     */
    #[Required(enum: Event::class)]
    public string $event;

    /**
     * ID of the resource that triggered the event. Use the caption, static rendition, or thumbnail ID for their Asset child events. Replaying asset events, job.created, or source.created requires a retained snapshot. Resource deletion does not prevent replay.
     */
    #[Required('object_id')]
    public string $objectID;

    /**
     * WebhookId specifies the webhook endpoint that will receive the notification.
     */
    #[Required('webhook_id')]
    public string $webhookID;

    /**
     * `new NotificationCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationCreateParams::with(event: ..., objectID: ..., webhookID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationCreateParams)
     *   ->withEvent(...)
     *   ->withObjectID(...)
     *   ->withWebhookID(...)
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
     */
    public static function with(
        Event|string $event,
        string $objectID,
        string $webhookID
    ): self {
        $self = new self;

        $self['event'] = $event;
        $self['objectID'] = $objectID;
        $self['webhookID'] = $webhookID;

        return $self;
    }

    /**
     * Event specifies the type of event that triggered the notification.
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
     * ID of the resource that triggered the event. Use the caption, static rendition, or thumbnail ID for their Asset child events. Replaying asset events, job.created, or source.created requires a retained snapshot. Resource deletion does not prevent replay.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * WebhookId specifies the webhook endpoint that will receive the notification.
     */
    public function withWebhookID(string $webhookID): self
    {
        $self = clone $this;
        $self['webhookID'] = $webhookID;

        return $self;
    }
}
