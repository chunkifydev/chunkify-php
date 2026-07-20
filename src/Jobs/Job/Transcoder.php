<?php

declare(strict_types=1);

namespace Chunkify\Jobs\Job;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Jobs\Job\Transcoder\Type;

/**
 * The transcoder configuration for a job.
 *
 * @phpstan-type TranscoderShape = array{
 *   auto: bool, quantity: int, type: Type|value-of<Type>
 * }
 */
final class Transcoder implements BaseModel
{
    /** @use SdkModel<TranscoderShape> */
    use SdkModel;

    /**
     * Whether the transcoder configuration is automatically set by Chunkify.
     */
    #[Required]
    public bool $auto;

    /**
     * Number of instances allocated.
     */
    #[Required]
    public int $quantity;

    /**
     * Type of transcoder instance.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Transcoder()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Transcoder::with(auto: ..., quantity: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Transcoder)->withAuto(...)->withQuantity(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        bool $auto,
        int $quantity,
        Type|string $type
    ): self {
        $self = new self;

        $self['auto'] = $auto;
        $self['quantity'] = $quantity;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Whether the transcoder configuration is automatically set by Chunkify.
     */
    public function withAuto(bool $auto): self
    {
        $self = clone $this;
        $self['auto'] = $auto;

        return $self;
    }

    /**
     * Number of instances allocated.
     */
    public function withQuantity(int $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * Type of transcoder instance.
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
