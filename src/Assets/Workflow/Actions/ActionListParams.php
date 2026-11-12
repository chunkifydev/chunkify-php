<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\Actions;

use Chunkify\Assets\Workflow\Actions\ActionListParams\Created;
use Chunkify\Assets\Workflow\Actions\ActionListParams\Status;
use Chunkify\Assets\Workflow\Actions\ActionListParams\Type;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * List retained Workflow actions for an Asset, newest first. Direct output requests are excluded.
 *
 * @see Chunkify\Services\Assets\Workflow\ActionsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Assets\Workflow\Actions\ActionListParams\Created
 *
 * @phpstan-type ActionListParamsShape = array{
 *   created?: null|Created|CreatedShape,
 *   latestPerAction?: bool|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   revision?: int|null,
 *   status?: null|Status|value-of<Status>,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class ActionListParams implements BaseModel
{
    /** @use SdkModel<ActionListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional]
    public ?Created $created;

    /**
     * LatestPerAction specifies whether to return only the latest execution of each rule and action on the Asset. Defaults to false. Pagination and total count apply after this selection.
     */
    #[Optional]
    public ?bool $latestPerAction;

    /**
     * Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Revision specifies the Workflow revision to filter by. Omit it to include all revisions.
     */
    #[Optional]
    public ?int $revision;

    /**
     * Status specifies the action status to filter by. Omit it to include all statuses.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Type specifies the action type to filter by. Omit it to include all action types.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

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
     * @param Status|value-of<Status>|null $status
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        Created|array|null $created = null,
        ?bool $latestPerAction = null,
        ?int $limit = null,
        ?int $offset = null,
        ?int $revision = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $created && $self['created'] = $created;
        null !== $latestPerAction && $self['latestPerAction'] = $latestPerAction;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $revision && $self['revision'] = $revision;
        null !== $status && $self['status'] = $status;
        null !== $type && $self['type'] = $type;

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
     * LatestPerAction specifies whether to return only the latest execution of each rule and action on the Asset. Defaults to false. Pagination and total count apply after this selection.
     */
    public function withLatestPerAction(bool $latestPerAction): self
    {
        $self = clone $this;
        $self['latestPerAction'] = $latestPerAction;

        return $self;
    }

    /**
     * Limit specifies the maximum number of results to return.
     * Accepts 1 to 100. Defaults to 100.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Offset specifies the number of matching results to skip.
     * Must be at least 0. Defaults to 0.
     */
    public function withOffset(int $offset): self
    {
        $self = clone $this;
        $self['offset'] = $offset;

        return $self;
    }

    /**
     * Revision specifies the Workflow revision to filter by. Omit it to include all revisions.
     */
    public function withRevision(int $revision): self
    {
        $self = clone $this;
        $self['revision'] = $revision;

        return $self;
    }

    /**
     * Status specifies the action status to filter by. Omit it to include all statuses.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Type specifies the action type to filter by. Omit it to include all action types.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
