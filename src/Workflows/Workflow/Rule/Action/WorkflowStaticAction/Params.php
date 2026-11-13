<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Workflow\Rule\Action\WorkflowStaticAction;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Workflows\Workflow\Rule\Action\WorkflowStaticAction\Params\Resolution;

/**
 * Params specifies the static rendition resolution.
 *
 * @phpstan-type ParamsShape = array{resolution: Resolution|value-of<Resolution>}
 */
final class Params implements BaseModel
{
    /** @use SdkModel<ParamsShape> */
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
     * `new Params()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Params::with(resolution: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Params)->withResolution(...)
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
