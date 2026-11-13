<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Assets\AssetError\Stage;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetErrorShape = array{
 *   code: string, message: string, stage: Stage|value-of<Stage>
 * }
 */
final class AssetError implements BaseModel
{
    /** @use SdkModel<AssetErrorShape> */
    use SdkModel;

    /**
     * Machine-readable processing error code.
     */
    #[Required]
    public string $code;

    /**
     * Description of the processing failure.
     */
    #[Required]
    public string $message;

    /**
     * Processing stage that failed.
     *
     * @var value-of<Stage> $stage
     */
    #[Required(enum: Stage::class)]
    public string $stage;

    /**
     * `new AssetError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetError::with(code: ..., message: ..., stage: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetError)->withCode(...)->withMessage(...)->withStage(...)
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
     * @param Stage|value-of<Stage> $stage
     */
    public static function with(
        string $code,
        string $message,
        Stage|string $stage
    ): self {
        $self = new self;

        $self['code'] = $code;
        $self['message'] = $message;
        $self['stage'] = $stage;

        return $self;
    }

    /**
     * Machine-readable processing error code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Description of the processing failure.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Processing stage that failed.
     *
     * @param Stage|value-of<Stage> $stage
     */
    public function withStage(Stage|string $stage): self
    {
        $self = clone $this;
        $self['stage'] = $stage;

        return $self;
    }
}
