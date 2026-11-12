<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnectionCreateParams\Type;

/**
 * Add a hosted connection or validate and save a custom server. Only team owners can create connections. Retry a known failed hosted setup with the same name to resume its saved project; an unknown creation outcome requires operator reconciliation.
 *
 * @see Chunkify\Services\Projects\AnalyticsConnectionsService::create()
 *
 * @phpstan-type AnalyticsConnectionCreateParamsShape = array{
 *   name: string,
 *   type: Type|value-of<Type>,
 *   endpoint?: string|null,
 *   publicIngestKey?: string|null,
 *   readKey?: string|null,
 * }
 */
final class AnalyticsConnectionCreateParams implements BaseModel
{
    /** @use SdkModel<AnalyticsConnectionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Name identifies this connection in the dashboard.
     */
    #[Required]
    public string $name;

    /**
     * Type specifies whether Chunkify manages the analytics project.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Endpoint specifies the custom server base URL. Required for custom connections and omitted for hosted connections.
     */
    #[Optional]
    public ?string $endpoint;

    /**
     * PublicIngestKey optionally enables preview tracking for a custom connection. Supply the public ingestion key for the same analytics project as read_key. It is returned in connection reads and used in browser code. Omit for hosted connections.
     */
    #[Optional('public_ingest_key')]
    public ?string $publicIngestKey;

    /**
     * ReadKey supplies a read-only project credential for a custom connection. Required for custom connections and omitted for hosted connections. Stored encrypted and never returned.
     */
    #[Optional('read_key')]
    public ?string $readKey;

    /**
     * `new AnalyticsConnectionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AnalyticsConnectionCreateParams::with(name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AnalyticsConnectionCreateParams)->withName(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $name,
        Type|string $type,
        ?string $endpoint = null,
        ?string $publicIngestKey = null,
        ?string $readKey = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['type'] = $type;

        null !== $endpoint && $self['endpoint'] = $endpoint;
        null !== $publicIngestKey && $self['publicIngestKey'] = $publicIngestKey;
        null !== $readKey && $self['readKey'] = $readKey;

        return $self;
    }

    /**
     * Name identifies this connection in the dashboard.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Type specifies whether Chunkify manages the analytics project.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Endpoint specifies the custom server base URL. Required for custom connections and omitted for hosted connections.
     */
    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    /**
     * PublicIngestKey optionally enables preview tracking for a custom connection. Supply the public ingestion key for the same analytics project as read_key. It is returned in connection reads and used in browser code. Omit for hosted connections.
     */
    public function withPublicIngestKey(string $publicIngestKey): self
    {
        $self = clone $this;
        $self['publicIngestKey'] = $publicIngestKey;

        return $self;
    }

    /**
     * ReadKey supplies a read-only project credential for a custom connection. Required for custom connections and omitted for hosted connections. Stored encrypted and never returned.
     */
    public function withReadKey(string $readKey): self
    {
        $self = clone $this;
        $self['readKey'] = $readKey;

        return $self;
    }
}
