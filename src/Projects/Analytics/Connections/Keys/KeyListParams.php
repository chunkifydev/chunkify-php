<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections\Keys;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * List keys for a hosted Chunkify Analytics server: the public key used by players to send events, and read-only secret key records for dashboard and MCP access. Secret values are not returned. Requires a team owner and a Team Access Key.
 *
 * @see Chunkify\Services\Projects\Analytics\Connections\KeysService::list()
 *
 * @phpstan-type KeyListParamsShape = array{projectID: string}
 */
final class KeyListParams implements BaseModel
{
    /** @use SdkModel<KeyListParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $projectID;

    /**
     * `new KeyListParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyListParams::with(projectID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyListParams)->withProjectID(...)
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
