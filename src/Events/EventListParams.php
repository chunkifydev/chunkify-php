<?php

declare(strict_types=1);

namespace Chunkify\Events;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Events\EventListParams\Created;
use Chunkify\Events\EventListParams\Event;

/**
 * List lifecycle events recorded with or without webhooks. Events and their deliveries expire according to the plan retention deadline. Historical notifications recorded before the event log remain available through Notifications.
 *
 * @see Chunkify\Services\EventsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Events\EventListParams\Created
 *
 * @phpstan-type EventListParamsShape = array{
 *   created?: null|Created|CreatedShape,
 *   events?: list<\Chunkify\Events\EventListParams\Event|value-of<\Chunkify\Events\EventListParams\Event>>|null,
 *   limit?: int|null,
 *   objectID?: string|null,
 *   offset?: int|null,
 * }
 */
final class EventListParams implements BaseModel
{
    /** @use SdkModel<EventListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?Created $created;

    /**
     * Filter by events.
     *
     * @var list<value-of<Event>>|null $events
     */
    #[Optional(list: Event::class)]
    public ?array $events;

    /**
     * Pagination limit (max 100).
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by the primary or a related resource ID, including retained associations after resource deletion.
     */
    #[Optional]
    public ?string $objectID;

    /**
     * Pagination offset.
     */
    #[Optional]
    public ?int $offset;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Created|CreatedShape|null $created
     * @param list<Event|value-of<Event>>|null $events
     */
    public static function with(
        Created|array|null $created = null,
        ?array $events = null,
        ?int $limit = null,
        ?string $objectID = null,
        ?int $offset = null,
    ): self {
        $self = new self;

        null !== $created && $self['created'] = $created;
        null !== $events && $self['events'] = $events;
        null !== $limit && $self['limit'] = $limit;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $offset && $self['offset'] = $offset;

        return $self;
    }

    /**
     * @param Created|CreatedShape $created
     */
    public function withCreated(Created|array $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * Filter by events.
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
     * Pagination limit (max 100).
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by the primary or a related resource ID, including retained associations after resource deletion.
     */
    public function withObjectID(string $objectID): self
    {
        $self = clone $this;
        $self['objectID'] = $objectID;

        return $self;
    }

    /**
     * Pagination offset.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }
}
