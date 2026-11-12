<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Runs\RunListParams\Created;
use Chunkify\Workflows\Runs\RunListParams\Status;

/**
 * List retained runs for this Workflow, newest first. Each run corresponds to one matching Asset event.
 *
 * @see Chunkify\Services\Workflows\RunsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Workflows\Runs\RunListParams\Created
 *
 * @phpstan-type RunListParamsShape = array{
 *   assetID?: string|null,
 *   created?: null|Created|CreatedShape,
 *   eventID?: string|null,
 *   latestPerAsset?: bool|null,
 *   limit?: int|null,
 *   offset?: int|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class RunListParams implements BaseModel
{
    /** @use SdkModel<RunListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * AssetId specifies the Asset whose results to return. Omit it to include all Assets.
     */
    #[Optional]
    public ?string $assetID;

    #[Optional]
    public ?Created $created;

    /**
     * EventId specifies the triggering event ID to filter by. Omit it to include all events.
     */
    #[Optional]
    public ?string $eventID;

    /**
     * LatestPerAsset specifies whether to return only the latest matching run for each Asset. Defaults to false. Pagination and total count apply to Assets when true.
     */
    #[Optional]
    public ?bool $latestPerAsset;

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
     * Status specifies the run status to filter by. Omit it to include all statuses.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

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
     */
    public static function with(
        ?string $assetID = null,
        Created|array|null $created = null,
        ?string $eventID = null,
        ?bool $latestPerAsset = null,
        ?int $limit = null,
        ?int $offset = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $assetID && $self['assetID'] = $assetID;
        null !== $created && $self['created'] = $created;
        null !== $eventID && $self['eventID'] = $eventID;
        null !== $latestPerAsset && $self['latestPerAsset'] = $latestPerAsset;
        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $status && $self['status'] = $status;

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
     * EventId specifies the triggering event ID to filter by. Omit it to include all events.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * LatestPerAsset specifies whether to return only the latest matching run for each Asset. Defaults to false. Pagination and total count apply to Assets when true.
     */
    public function withLatestPerAsset(bool $latestPerAsset): self
    {
        $self = clone $this;
        $self['latestPerAsset'] = $latestPerAsset;

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
     * Status specifies the run status to filter by. Omit it to include all statuses.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
