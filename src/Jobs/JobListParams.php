<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Conversion\ListOf;
use Chunkify\Jobs\JobListParams\Created;
use Chunkify\Jobs\JobListParams\FormatID;
use Chunkify\Jobs\JobListParams\Status;

/**
 * Retrieve a list of jobs with optional filtering and pagination.
 *
 * @see Chunkify\Services\JobsService::list()
 *
 * @phpstan-import-type CreatedShape from \Chunkify\Jobs\JobListParams\Created
 *
 * @phpstan-type JobListParamsShape = array{
 *   id?: string|null,
 *   created?: null|Created|CreatedShape,
 *   formatID?: null|FormatID|value-of<FormatID>,
 *   hlsManifestID?: string|null,
 *   limit?: int|null,
 *   metadata?: list<list<string>>|null,
 *   offset?: int|null,
 *   sourceID?: string|null,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class JobListParams implements BaseModel
{
    /** @use SdkModel<JobListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Filter by job ID.
     */
    #[Optional]
    public ?string $id;

    #[Optional]
    public ?Created $created;

    /**
     * Filter by format id.
     *
     * @var value-of<FormatID>|null $formatID
     */
    #[Optional(enum: FormatID::class)]
    public ?string $formatID;

    /**
     * Filter by hls manifest ID.
     */
    #[Optional]
    public ?string $hlsManifestID;

    /**
     * Pagination limit.
     */
    #[Optional]
    public ?int $limit;

    /**
     * Filter by metadata.
     *
     * @var list<list<string>>|null $metadata
     */
    #[Optional(list: new ListOf('string'))]
    public ?array $metadata;

    /**
     * Pagination offset.
     */
    #[Optional]
    public ?int $offset;

    /**
     * Filter by source ID.
     */
    #[Optional]
    public ?string $sourceID;

    /**
     * Filter by job status.
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
     * @param FormatID|value-of<FormatID>|null $formatID
     * @param list<list<string>>|null $metadata
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        ?string $id = null,
        Created|array|null $created = null,
        FormatID|string|null $formatID = null,
        ?string $hlsManifestID = null,
        ?int $limit = null,
        ?array $metadata = null,
        ?int $offset = null,
        ?string $sourceID = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        null !== $id && $self['id'] = $id;
        null !== $created && $self['created'] = $created;
        null !== $formatID && $self['formatID'] = $formatID;
        null !== $hlsManifestID && $self['hlsManifestID'] = $hlsManifestID;
        null !== $limit && $self['limit'] = $limit;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $offset && $self['offset'] = $offset;
        null !== $sourceID && $self['sourceID'] = $sourceID;
        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Filter by job ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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
     * Filter by format id.
     *
     * @param FormatID|value-of<FormatID> $formatID
     */
    public function withFormatID(FormatID|string $formatID): self
    {
        $self = clone $this;
        $self['formatID'] = $formatID;

        return $self;
    }

    /**
     * Filter by hls manifest ID.
     */
    public function withHlsManifestID(string $hlsManifestID): self
    {
        $self = clone $this;
        $self['hlsManifestID'] = $hlsManifestID;

        return $self;
    }

    /**
     * Pagination limit.
     */
    public function withLimit(int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }

    /**
     * Filter by metadata.
     *
     * @param list<list<string>> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

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
     * Filter by source ID.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Filter by job status.
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
