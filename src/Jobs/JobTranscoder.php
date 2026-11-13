<?php

declare(strict_types=1);

namespace Chunkify\Jobs;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\InstanceType;

/**
 * The transcoder configuration for a job.
 *
 * @phpstan-type JobTranscoderShape = array{
 *   auto: bool, quantity: int, type: InstanceType|value-of<InstanceType>
 * }
 */
final class JobTranscoder implements BaseModel
{
    /** @use SdkModel<JobTranscoderShape> */
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
     * @var value-of<InstanceType> $type
     */
    #[Required(enum: InstanceType::class)]
    public string $type;

    /**
     * `new JobTranscoder()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JobTranscoder::with(auto: ..., quantity: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JobTranscoder)->withAuto(...)->withQuantity(...)->withType(...)
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
     * @param InstanceType|value-of<InstanceType> $type
     */
    public static function with(
        bool $auto,
        int $quantity,
        InstanceType|string $type
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
     * @param InstanceType|value-of<InstanceType> $type
     */
    public function withType(InstanceType|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
