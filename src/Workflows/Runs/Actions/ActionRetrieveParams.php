<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Runs\Actions;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Retrieve one action execution in a retained Workflow run, including its resolved inputs, status, and result.
 *
 * @see Chunkify\Services\Workflows\Runs\ActionsService::retrieve()
 *
 * @phpstan-type ActionRetrieveParamsShape = array{
 *   workflowID: string, runID: string
 * }
 */
final class ActionRetrieveParams implements BaseModel
{
    /** @use SdkModel<ActionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $workflowID;

    #[Required]
    public string $runID;

    /**
     * `new ActionRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ActionRetrieveParams::with(workflowID: ..., runID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ActionRetrieveParams)->withWorkflowID(...)->withRunID(...)
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
    public static function with(string $workflowID, string $runID): self
    {
        $self = new self;

        $self['workflowID'] = $workflowID;
        $self['runID'] = $runID;

        return $self;
    }

    public function withWorkflowID(string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }

    public function withRunID(string $runID): self
    {
        $self = clone $this;
        $self['runID'] = $runID;

        return $self;
    }
}
