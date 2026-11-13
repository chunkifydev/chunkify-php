<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetTranscriptOutputCreateParams;

use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Parameters for an original-language transcript. Pass an empty object; the spoken language is detected automatically.
 *
 * @phpstan-type ParamsShape = array<string,mixed>
 */
final class Params implements BaseModel
{
    /** @use SdkModel<ParamsShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
