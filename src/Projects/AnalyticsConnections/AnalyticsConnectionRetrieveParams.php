<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Retrieve non-secret connection metadata within its owning project.
 *
 * @see Chunkify\Services\Projects\AnalyticsConnectionsService::retrieve()
 *
 * @phpstan-type AnalyticsConnectionRetrieveParamsShape = array{projectID: string}
 */
final class AnalyticsConnectionRetrieveParams implements BaseModel
{
    /** @use SdkModel<AnalyticsConnectionRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $projectID;

    /**
     * `new AnalyticsConnectionRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AnalyticsConnectionRetrieveParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AnalyticsConnectionRetrieveParams)->withProjectID(...)
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
    public static function with(string $projectID): self
    {
        $self = new self;

        $self['projectID'] = $projectID;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }
}
