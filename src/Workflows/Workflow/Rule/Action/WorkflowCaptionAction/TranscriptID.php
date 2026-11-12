<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Workflow\Rule\Action\WorkflowCaptionAction;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Workflow\Rule\Action\WorkflowCaptionAction\TranscriptID\From;

/**
 * TranscriptId binds caption publication to the transcript in the triggering event. Use it only when connected to create_transcript. When omitted, creates or reuses the Asset’s original transcript.
 *
 * @phpstan-type TranscriptIDShape = array{from: From|value-of<From>}
 */
final class TranscriptID implements BaseModel
{
    /** @use SdkModel<TranscriptIDShape> */
    use SdkModel;

    /**
     * From specifies where to read the input output ID. Use event.output.id to consume the output in the triggering asset.output.ready event.
     *
     * @var value-of<From> $from
     */
    #[Required(enum: From::class)]
    public string $from;

    /**
     * `new TranscriptID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscriptID::with(from: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscriptID)->withFrom(...)
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
     * @param From|value-of<From> $from
     */
    public static function with(From|string $from): self
    {
        $self = new self;

        $self['from'] = $from;

        return $self;
    }

    /**
     * From specifies where to read the input output ID. Use event.output.id to consume the output in the triggering asset.output.ready event.
     *
     * @param From|value-of<From> $from
     */
    public function withFrom(From|string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }
}
