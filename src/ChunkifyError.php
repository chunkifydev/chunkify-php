<?php

declare(strict_types=1);

namespace Chunkify;

use Chunkify\ChunkifyError\Type;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChunkifyErrorShape = array{
 *   detail: string, message: string, type: Type|value-of<Type>
 * }
 */
final class ChunkifyError implements BaseModel
{
    /** @use SdkModel<ChunkifyErrorShape> */
    use SdkModel;

    /**
     * Additional error details or output.
     */
    #[Required]
    public string $detail;

    /**
     * Main error message.
     */
    #[Required]
    public string $message;

    /**
     * Type of error.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new ChunkifyError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChunkifyError::with(detail: ..., message: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChunkifyError)->withDetail(...)->withMessage(...)->withType(...)
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
        string $detail,
        string $message,
        Type|string $type
    ): self {
        $self = new self;

        $self['detail'] = $detail;
        $self['message'] = $message;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Additional error details or output.
     */
    public function withDetail(string $detail): self
    {
        $self = clone $this;
        $self['detail'] = $detail;

        return $self;
    }

    /**
     * Main error message.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Type of error.
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
