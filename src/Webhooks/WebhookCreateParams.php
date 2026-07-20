<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Webhooks\WebhookCreateParams\Event;

/**
 * Create a new webhook for a project. The webhook will receive notifications for specified events.
 *
 * @see Chunkify\Services\WebhooksService::create()
 *
 * @phpstan-type WebhookCreateParamsShape = array{
 *   url: string, enabled?: bool|null, events?: list<Event|value-of<Event>>|null
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    /** @use SdkModel<WebhookCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Url is the endpoint that will receive webhook notifications, which must be a valid HTTP URL.
     */
    #[Required]
    public string $url;

    /**
     * Enabled indicates whether the webhook is active.
     */
    #[Optional]
    public ?bool $enabled;

    /**
     * Events specifies the types of events that will trigger the webhook.
     *
     * @var list<value-of<Event>>|null $events
     */
    #[Optional(list: Event::class)]
    public ?array $events;

    /**
     * `new WebhookCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookCreateParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookCreateParams)->withURL(...)
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
     * @param list<Event|value-of<Event>>|null $events
     */
    public static function with(
        string $url,
        ?bool $enabled = null,
        ?array $events = null
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $enabled && $self['enabled'] = $enabled;
        null !== $events && $self['events'] = $events;

        return $self;
    }

    /**
     * Url is the endpoint that will receive webhook notifications, which must be a valid HTTP URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Enabled indicates whether the webhook is active.
     */
    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * Events specifies the types of events that will trigger the webhook.
     *
     * @param list<Event|value-of<Event>> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }
}
