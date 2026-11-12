<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs;

use Chunkify\Assets\Outputs\OutputListParams\Status;
use Chunkify\Assets\Outputs\OutputListParams\Type;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * List outputs requested directly or by a Workflow. Results are ordered by creation date, newest first, with descending output ID as a tie-breaker. Pagination and total apply after type and status filters. Core playback, poster and default timeline previews remain on the Asset.
 *
 * @see Chunkify\Services\Assets\OutputsService::list()
 *
 * @phpstan-type OutputListParamsShape = array{
 *   limit?: int|null,
 *   offset?: int|null,
 *   status?: null|Status|value-of<Status>,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class OutputListParams implements BaseModel
{
    /** @use SdkModel<OutputListParamsShape> */
    use SdkModel;
    use SdkParams;

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
     * Status specifies the current output state to include. Omit it to include all states.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * Type specifies the output kind to include. Omit it to include all kinds.
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
     * @param Status|value-of<Status>|null $status
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?int $limit = null,
        ?int $offset = null,
        Status|string|null $status = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        null !== $limit && $self['limit'] = $limit;
        null !== $offset && $self['offset'] = $offset;
        null !== $status && $self['status'] = $status;
        null !== $type && $self['type'] = $type;

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
     * Status specifies the current output state to include. Omit it to include all states.
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
     * Type specifies the output kind to include. Omit it to include all kinds.
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
