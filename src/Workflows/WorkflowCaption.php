<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Parameters for generating original captions. Pass an empty object; the spoken language is detected automatically.
 *
 * @phpstan-type WorkflowCaptionShape = array<string,mixed>
 */
final class WorkflowCaption implements BaseModel
{
    /** @use SdkModel<WorkflowCaptionShape> */
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
