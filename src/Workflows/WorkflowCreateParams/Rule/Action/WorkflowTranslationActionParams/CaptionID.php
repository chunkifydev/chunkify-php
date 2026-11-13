<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowTranslationActionParams;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowTranslationActionParams\CaptionID\From;

/**
 * CaptionId specifies the binding to the original caption in the triggering event.
 *
 * @phpstan-type CaptionIDShape = array{from: From|value-of<From>}
 */
final class CaptionID implements BaseModel
{
    /** @use SdkModel<CaptionIDShape> */
    use SdkModel;

    /**
     * From specifies where to read the input output ID. Use event.output.id to consume the output in the triggering asset.output.ready event.
     *
     * @var value-of<From> $from
     */
    #[Required(enum: From::class)]
    public string $from;

    /**
     * `new CaptionID()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CaptionID::with(from: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CaptionID)->withFrom(...)
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
