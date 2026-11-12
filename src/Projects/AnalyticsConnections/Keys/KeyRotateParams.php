<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections\Keys;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Rotate a public or read-only secret key for a hosted Chunkify Analytics server. Update the player, dashboard, or MCP client with the new key; the old key stops working immediately. Requires a team owner and a Team Access Key.
 *
 * @see Chunkify\Services\Projects\AnalyticsConnections\KeysService::rotate()
 *
 * @phpstan-type KeyRotateParamsShape = array{
 *   projectID: string, connectionID: string
 * }
 */
final class KeyRotateParams implements BaseModel
{
    /** @use SdkModel<KeyRotateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $projectID;

    #[Required]
    public string $connectionID;

    /**
     * `new KeyRotateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyRotateParams::with(projectID: ..., connectionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyRotateParams)->withProjectID(...)->withConnectionID(...)
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
    public static function with(string $projectID, string $connectionID): self
    {
        $self = new self;

        $self['projectID'] = $projectID;
        $self['connectionID'] = $connectionID;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    public function withConnectionID(string $connectionID): self
    {
        $self = clone $this;
        $self['connectionID'] = $connectionID;

        return $self;
    }
}
