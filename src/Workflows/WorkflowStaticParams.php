<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\WorkflowStaticParams\Resolution;

/**
 * Parameters for creating one static rendition.
 *
 * @phpstan-type WorkflowStaticParamsShape = array{
 *   resolution: Resolution|value-of<Resolution>
 * }
 */
final class WorkflowStaticParams implements BaseModel
{
    /** @use SdkModel<WorkflowStaticParamsShape> */
    use SdkModel;

    /**
     * Resolution specifies the H.264 MP4 output resolution. highest selects the largest supported output without upscaling.
     * Hobby supports up to 1080p; other plans support up to 2160p. Streaming resolution limits do not apply.
     *
     * @var value-of<Resolution> $resolution
     */
    #[Required(enum: Resolution::class)]
    public string $resolution;

    /**
     * `new WorkflowStaticParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkflowStaticParams::with(resolution: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkflowStaticParams)->withResolution(...)
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
     * @param Resolution|value-of<Resolution> $resolution
     */
    public static function with(Resolution|string $resolution): self
    {
        $self = new self;

        $self['resolution'] = $resolution;

        return $self;
    }

    /**
     * Resolution specifies the H.264 MP4 output resolution. highest selects the largest supported output without upscaling.
     * Hobby supports up to 1080p; other plans support up to 2160p. Streaming resolution limits do not apply.
     *
     * @param Resolution|value-of<Resolution> $resolution
     */
    public function withResolution(Resolution|string $resolution): self
    {
        $self = clone $this;
        $self['resolution'] = $resolution;

        return $self;
    }
}
