<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Update the enabled status of a webhook. The webhook must belong to the current project.
 *
 * @see Chunkify\Services\WebhooksService::update()
 *
 * @phpstan-type WebhookUpdateParamsShape = array{
 *   enabled?: bool|null, events?: list<WebhookEvent|value-of<WebhookEvent>>|null
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    /** @use SdkModel<WebhookUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Enabled indicates whether the webhook should be enabled or disabled.
     */
    #[Optional]
    public ?bool $enabled;

    /**
     * Events specifies the types of events that will trigger the webhook.
     *
     * @var list<value-of<WebhookEvent>>|null $events
     */
    #[Optional(list: WebhookEvent::class)]
    public ?array $events;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<WebhookEvent|value-of<WebhookEvent>>|null $events
     */
    public static function with(
        ?bool $enabled = null,
        ?array $events = null
    ): self {
        $self = new self;

        null !== $enabled && $self['enabled'] = $enabled;
        null !== $events && $self['events'] = $events;

        return $self;
    }

    /**
     * Enabled indicates whether the webhook should be enabled or disabled.
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
     * @param list<WebhookEvent|value-of<WebhookEvent>> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }
}
