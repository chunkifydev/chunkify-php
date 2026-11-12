<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections\Keys;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Projects\Analytics\Connections\Keys\KeyCreateParams\Purpose;

/**
 * Generate a public key for players to send events, or a read-only secret key for a dashboard or MCP client to query a hosted Chunkify Analytics server. Save secret keys when returned. Requires a team owner and a Team Access Key.
 *
 * @see Chunkify\Services\Projects\Analytics\Connections\KeysService::create()
 *
 * @phpstan-type KeyCreateParamsShape = array{
 *   projectID: string, purpose: Purpose|value-of<Purpose>
 * }
 */
final class KeyCreateParams implements BaseModel
{
    /** @use SdkModel<KeyCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $projectID;

    /**
     * Purpose distinguishes player ingestion, read-only API access and a separate read-only MCP credential. Read and MCP keys have the same collector permissions.
     *
     * @var value-of<Purpose> $purpose
     */
    #[Required(enum: Purpose::class)]
    public string $purpose;

    /**
     * `new KeyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KeyCreateParams::with(projectID: ..., purpose: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KeyCreateParams)->withProjectID(...)->withPurpose(...)
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
     *
     * @param Purpose|value-of<Purpose> $purpose
     */
    public static function with(
        string $projectID,
        Purpose|string $purpose
    ): self {
        $self = new self;

        $self['projectID'] = $projectID;
        $self['purpose'] = $purpose;

        return $self;
    }

    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Purpose distinguishes player ingestion, read-only API access and a separate read-only MCP credential. Read and MCP keys have the same collector permissions.
     *
     * @param Purpose|value-of<Purpose> $purpose
     */
    public function withPurpose(Purpose|string $purpose): self
    {
        $self = clone $this;
        $self['purpose'] = $purpose;

        return $self;
    }
}
