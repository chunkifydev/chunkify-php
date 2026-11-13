<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\InstanceType;

/**
 * @phpstan-type JobCreateTranscoderParamsShape = array{
 *   quantity?: int|null, type?: null|InstanceType|value-of<InstanceType>
 * }
 */
final class JobCreateTranscoderParams implements BaseModel
{
    /** @use SdkModel<JobCreateTranscoderParamsShape> */
    use SdkModel;

    /**
     * Quantity specifies the number of transcoder instances.
     * Required if Type is set.
     */
    #[Optional]
    public ?int $quantity;

    /**
     * Type specifies the CPU configuration for each transcoder instance.
     * Required if Quantity is set.
     *
     * @var value-of<InstanceType>|null $type
     */
    #[Optional(enum: InstanceType::class)]
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
     * @param InstanceType|value-of<InstanceType>|null $type
     */
    public static function with(
        ?int $quantity = null,
        InstanceType|string|null $type = null
    ): self {
        $self = new self;

        null !== $quantity && $self['quantity'] = $quantity;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Quantity specifies the number of transcoder instances.
     * Required if Type is set.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Type specifies the CPU configuration for each transcoder instance.
     * Required if Quantity is set.
     *
     * @param InstanceType|value-of<InstanceType> $type
     */
    public function withType(InstanceType|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
