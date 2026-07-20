<?php

declare(strict_types=1);

namespace Chunkify\Notifications;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Notifications\NotificationListParams\Created;
use Chunkify\Notifications\NotificationListParams\Event;
use Chunkify\Notifications\NotificationListParams\ResponseStatusCode;

/**
 * Retrieve a list of notifications with optional filtering and pagination.
 *
 * @see Chunkify\Services\NotificationsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Notifications\NotificationListParams\Created
 * @phpstan-import-type ResponseStatusCodeShape from \Chunkify\Notifications\NotificationListParams\ResponseStatusCode
 *
 * @phpstan-type NotificationListParamsShape = array{
 *   created?: null|Created|CreatedShape,
 *   events?: list<Event|value-of<Event>>|null,
 *   limit?: int|null,
 *   objectID?: string|null,
 *   offset?: int|null,
 *   responseStatusCode?: null|ResponseStatusCode|ResponseStatusCodeShape,
 *   webhookID?: string|null,
 * }
 */
final class NotificationListParams implements BaseModel
{
    /** @use SdkModel<NotificationListParamsShape> */
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
     * Filter by object ID.
     */
    #[Optional]
    public ?string $objectID;

    /**
     * Pagination offset.
     */
    #[Optional]
    public ?int $offset;

    #[Optional]
    public ?ResponseStatusCode $responseStatusCode;

    /**
     * Filter by webhook ID.
     */
    #[Optional]
    public ?string $webhookID;

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
     * @param ResponseStatusCode|ResponseStatusCodeShape|null $responseStatusCode
     */
    public static function with(
        Created|array|null $created = null,
        ?array $events = null,
        ?int $limit = null,
        ?string $objectID = null,
        ?int $offset = null,
        ResponseStatusCode|array|null $responseStatusCode = null,
        ?string $webhookID = null,
    ): self {
        $self = new self;

        null !== $created && $self['created'] = $created;
        null !== $events && $self['events'] = $events;
        null !== $limit && $self['limit'] = $limit;
        null !== $objectID && $self['objectID'] = $objectID;
        null !== $offset && $self['offset'] = $offset;
        null !== $responseStatusCode && $self['responseStatusCode'] = $responseStatusCode;
        null !== $webhookID && $self['webhookID'] = $webhookID;

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
     * Filter by object ID.
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

    /**
     * @param ResponseStatusCode|ResponseStatusCodeShape $responseStatusCode
     */
    public function withResponseStatusCode(
        ResponseStatusCode|array $responseStatusCode
    ): self {
        $self = clone $this;
        $self['responseStatusCode'] = $responseStatusCode;

        return $self;
    }

    /**
     * Filter by webhook ID.
     */
    public function withWebhookID(string $webhookID): self
    {
        $self = clone $this;
        $self['webhookID'] = $webhookID;

        return $self;
    }
}
