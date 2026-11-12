<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create one caption, static rendition or additional thumbnail output. The accepted output processes asynchronously and is returned in the same envelope as output reads.
 *
 * @see Chunkify\Services\Assets\OutputsService::create()
 *
 * @phpstan-type OutputCreateParamsShape = array{type: 'transcript', params: mixed}
 */
final class OutputCreateParams implements BaseModel
{
    /** @use SdkModel<OutputCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Type specifies the output kind.
     *
     * @var 'transcript' $type
     */
    #[Required]
    public string $type = 'transcript';

    /**
     * Parameters for an original-language transcript. Pass an empty object; the spoken language is detected automatically.
     */
    #[Required]
    public mixed $params;

    /**
     * `new OutputCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OutputCreateParams::with(params: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OutputCreateParams)->withParams(...)
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
     */
    public static function with(mixed $params): self
    {
        $self = new self;

        $self['params'] = $params;

        return $self;
    }

    /**
     * Type specifies the output kind.
     *
     * @param 'transcript' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Parameters for an original-language transcript. Pass an empty object; the spoken language is detected automatically.
     */
    public function withParams(mixed $params): self
    {
        $self = clone $this;
        $self['params'] = $params;

        return $self;
    }
}
