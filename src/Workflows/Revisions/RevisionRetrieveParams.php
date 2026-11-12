<?php

declare(strict_types=1);

namespace Chunkify\Workflows\Revisions;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Retrieve an immutable definition revision, including revisions of archived Workflows.
 *
 * @see Chunkify\Services\Workflows\RevisionsService::retrieve()
 *
 * @phpstan-type RevisionRetrieveParamsShape = array{workflowID: string}
 */
final class RevisionRetrieveParams implements BaseModel
{
    /** @use SdkModel<RevisionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $workflowID;

    /**
     * `new RevisionRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RevisionRetrieveParams::with(workflowID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RevisionRetrieveParams)->withWorkflowID(...)
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
