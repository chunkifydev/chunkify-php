<?php

declare(strict_types=1);

namespace Chunkify\Jobs\JobCreateParams;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\JobCreateParams\Transcoder\Type;

/**
 * Optional transcoder configuration. If not provided, the system will automatically
 * calculate the optimal quantity and CPU type based on the source file specifications
 * and output requirements. This auto-scaling ensures efficient resource utilization.
 *
 * @phpstan-type TranscoderShape = array{
 *   quantity?: int|null, type?: null|Type|value-of<Type>
 * }
 */
final class Transcoder implements BaseModel
{
    /** @use SdkModel<TranscoderShape> */
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
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        ?int $quantity = null,
        Type|string|null $type = null
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
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
