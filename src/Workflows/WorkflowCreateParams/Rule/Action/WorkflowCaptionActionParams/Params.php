<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowCaptionActionParams;

use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Params specifies caption generation settings. Pass an empty object.
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
