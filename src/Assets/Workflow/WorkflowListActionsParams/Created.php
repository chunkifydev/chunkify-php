<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\WorkflowListActionsParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type CreatedShape = array{gte?: int|null, lte?: int|null}
 */
final class Created implements BaseModel
{
    /** @use SdkModel<CreatedShape> */
    use SdkModel;

    /**
     * Created at or after this Unix timestamp in seconds.
     */
    #[Optional]
    public ?int $gte;

    /**
     * Created at or before this Unix timestamp in seconds.
     */
    #[Optional]
    public ?int $lte;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $gte = null, ?int $lte = null): self
    {
        $self = new self;

        null !== $gte && $self['gte'] = $gte;
        null !== $lte && $self['lte'] = $lte;

        return $self;
    }

    /**
     * Created at or after this Unix timestamp in seconds.
     */
    public function withGte(int $gte): self
    {
        $self = clone $this;
        $self['gte'] = $gte;

        return $self;
    }

    /**
     * Created at or before this Unix timestamp in seconds.
     */
    public function withLte(int $lte): self
    {
        $self = clone $this;
        $self['lte'] = $lte;

        return $self;
    }
}
