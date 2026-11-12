<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\Transcoding;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\Transcoding\Error\Stage;

/**
 * Error describes why processing failed. Omitted when no processing error exists.
 *
 * @phpstan-type ErrorShape = array{
 *   code: string, message: string, stage: Stage|value-of<Stage>
 * }
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * Code identifies the processing failure.
     */
    #[Required]
    public string $code;

    /**
     * Message describes the failure without internal worker or provider diagnostics.
     */
    #[Required]
    public string $message;

    /**
     * Stage identifies where processing failed.
     *
     * @var value-of<Stage> $stage
     */
    #[Required(enum: Stage::class)]
    public string $stage;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(code: ..., message: ..., stage: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withCode(...)->withMessage(...)->withStage(...)
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
     * Code identifies the processing failure.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }

    /**
     * Message describes the failure without internal worker or provider diagnostics.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Stage identifies where processing failed.
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
