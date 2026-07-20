<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\Webhook\Event;

/**
 * @phpstan-type WebhookShape = array{
 *   id: string,
 *   enabled: bool,
 *   events: list<Event|value-of<Event>>,
 *   projectID: string,
 *   url: string,
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<WebhookShape> */
    use SdkModel;

    /**
     * Unique identifier of the webhook.
     */
    #[Required]
    public string $id;

    /**
     * Whether the webhook is currently enabled.
     */
    #[Required]
    public bool $enabled;

    /**
     * Array of event types this webhook subscribes to.
     *
     * @var list<value-of<Event>> $events
     */
    #[Required(list: Event::class)]
    public array $events;

    /**
     * ID of the project this webhook belongs to.
     */
    #[Required('project_id')]
    public string $projectID;

    /**
     * URL where webhook events will be sent.
     */
    #[Required]
    public string $url;

    /**
     * `new Webhook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Webhook::with(id: ..., enabled: ..., events: ..., projectID: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Webhook)
     *   ->withID(...)
     *   ->withEnabled(...)
     *   ->withEvents(...)
     *   ->withProjectID(...)
     *   ->withURL(...)
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
     * @param list<Event|value-of<Event>> $events
     */
    public static function with(
        string $id,
        bool $enabled,
        array $events,
        string $projectID,
        string $url
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['enabled'] = $enabled;
        $self['events'] = $events;
        $self['projectID'] = $projectID;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Unique identifier of the webhook.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Whether the webhook is currently enabled.
     */
    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * Array of event types this webhook subscribes to.
     *
     * @param list<Event|value-of<Event>> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    /**
     * ID of the project this webhook belongs to.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * URL where webhook events will be sent.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
