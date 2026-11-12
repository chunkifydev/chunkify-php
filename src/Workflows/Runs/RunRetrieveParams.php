<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Retrieve a retained run with its triggering event, status, and action counts.
 *
 * @see Chunkify\Services\Workflows\RunsService::retrieve()
 *
 * @phpstan-type RunRetrieveParamsShape = array{workflowID: string}
 */
final class RunRetrieveParams implements BaseModel
{
    /** @use SdkModel<RunRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $workflowID;

    /**
     * `new RunRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RunRetrieveParams::with(workflowID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RunRetrieveParams)->withWorkflowID(...)
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
    public static function with(string $workflowID): self
    {
        $self = new self;

        $self['workflowID'] = $workflowID;

        return $self;
    }

    public function withWorkflowID(string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
