<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * A customer-facing Transcoding processing failure.
 *
 * @phpstan-type TranscodingErrorShape = array{
 *   code: string,
 *   message: string,
 *   stage: TranscodingProcessingStage|value-of<TranscodingProcessingStage>,
 * }
 */
final class TranscodingError implements BaseModel
{
    /** @use SdkModel<TranscodingErrorShape> */
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
     * @var value-of<TranscodingProcessingStage> $stage
     */
    #[Required(enum: TranscodingProcessingStage::class)]
    public string $stage;

    /**
     * `new TranscodingError()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscodingError::with(code: ..., message: ..., stage: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscodingError)->withCode(...)->withMessage(...)->withStage(...)
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
     * @param TranscodingProcessingStage|value-of<TranscodingProcessingStage> $stage
     */
    public static function with(
        string $code,
        string $message,
        TranscodingProcessingStage|string $stage
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
     * @param TranscodingProcessingStage|value-of<TranscodingProcessingStage> $stage
     */
    public function withStage(TranscodingProcessingStage|string $stage): self
    {
        $self = clone $this;
        $self['stage'] = $stage;

        return $self;
    }
}
