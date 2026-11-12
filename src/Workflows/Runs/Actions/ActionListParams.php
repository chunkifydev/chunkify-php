<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs\Actions;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Created;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Status;
use Chunkify\Workflows\Runs\Actions\ActionListParams\Type;

/**
 * List actions in a retained Workflow run, newest first. Includes resolved inputs, statuses, output references, and skip or failure reasons.
 *
 * @see Chunkify\Services\Workflows\Runs\ActionsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Workflows\Runs\Actions\ActionListParams\Created
 *
 * @phpstan-type ActionListParamsShape = array{
 *   workflowID: string,
 *   assetID?: string|null,
 *   created?: null|Created|CreatedShape,
 *   limit?: int|null,
 *   offset?: int|null,
 *   status?: null|Status|value-of<Status>,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class ActionListParams implements BaseModel
{
    /** @use SdkModel<ActionListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $workflowID;

    /**
     * AssetId specifies the Asset whose results to return. Omit it to include all Assets.
     */
    #[Optional]
    public ?string $assetID;

    #[Optional]
    public ?Created $created;

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

    /**
     * `new ActionListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ActionListParams::with(workflowID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ActionListParams)->withWorkflowID(...)
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
     * @param Created|CreatedShape|null $created
     * @param Status|value-of<Status>|null $status
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $workflowID,
        ?string $assetID = null,
        Created|array|null $created = null,
        ?int $limit = null,
        ?int $offset = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['workflowID'] = $workflowID;

        null !== $assetID && $self['assetID'] = $assetID;
        null !== $created && $self['created'] = $created;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $status && $self['status'] = $status;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withWorkflowID(string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * AssetId specifies the Asset whose results to return. Omit it to include all Assets.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

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
