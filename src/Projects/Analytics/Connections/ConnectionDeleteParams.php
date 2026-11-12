<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * For hosted connections, delete the linked analytics project and invalidate its keys before removing the saved connection. Stored events expire under the collector retention policy. For custom connections, remove only the saved credentials and connection; the remote server, project and data remain unchanged. Only team owners can delete connections. An uncertain remote result preserves the connection for reconciliation.
 *
 * @see Chunkify\Services\Projects\Analytics\ConnectionsService::delete()
 *
 * @phpstan-type ConnectionDeleteParamsShape = array{projectID: string}
 */
final class ConnectionDeleteParams implements BaseModel
{
    /** @use SdkModel<ConnectionDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $projectID;

    /**
     * `new ConnectionDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConnectionDeleteParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConnectionDeleteParams)->withProjectID(...)
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
