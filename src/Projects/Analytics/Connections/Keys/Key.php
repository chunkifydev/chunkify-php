<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections\Keys;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Projects\Analytics\Connections\Keys\Key\Purpose;

/**
 * One key per purpose. Public player values remain available; read and MCP values are returned only on creation or rotation.
 *
 * @phpstan-type KeyShape = array{
 *   id: string, purpose: Purpose|value-of<Purpose>, publicKey?: string|null
 * }
 */
final class Key implements BaseModel
{
    /** @use SdkModel<KeyShape> */
    use SdkModel;

    /**
     * Id identifies this key in the collector.
     */
    #[Required]
    public string $id;

    /**
     * Purpose distinguishes player ingestion, read-only API access and a separate read-only MCP credential. Read and MCP keys have the same collector permissions.
     *
     * @var value-of<Purpose> $purpose
     */
    #[Required(enum: Purpose::class)]
    public string $purpose;

    /**
     * PublicKey is the browser ingestion credential for a player key. Omitted for read-only API and MCP keys, whose secret values are shown once.
     */
    #[Optional('public_key')]
    public ?string $publicKey;

    /**
     * `new Key()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Key::with(id: ..., purpose: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Key)->withID(...)->withPurpose(...)
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
        string $id,
        Purpose|string $purpose,
        ?string $publicKey = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['purpose'] = $purpose;

        null !== $publicKey && $self['publicKey'] = $publicKey;

        return $self;
    }

    /**
     * Id identifies this key in the collector.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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

    /**
     * PublicKey is the browser ingestion credential for a player key. Omitted for read-only API and MCP keys, whose secret values are shown once.
     */
    public function withPublicKey(string $publicKey): self
    {
        $self = clone $this;
        $self['publicKey'] = $publicKey;

        return $self;
    }
}
