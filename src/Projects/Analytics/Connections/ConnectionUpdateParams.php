<?php

declare(strict_types=1);

namespace Chunkify\Projects\Analytics\Connections;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Rename a connection or validate replacement custom credentials. Only team owners can update connections. Existing settings remain unchanged if validation fails.
 *
 * @see Chunkify\Services\Projects\Analytics\ConnectionsService::update()
 *
 * @phpstan-type ConnectionUpdateParamsShape = array{
 *   allowedOrigins?: list<string>|null,
 *   defaultForDashboard?: bool|null,
 *   endpoint?: string|null,
 *   name?: string|null,
 *   publicIngestKey?: string|null,
 *   readKey?: string|null,
 * }
 */
final class ConnectionUpdateParams implements BaseModel
{
    /** @use SdkModel<ConnectionUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * AllowedOrigins lists additional website origins permitted to ingest events for a hosted connection. Shared installation origins remain allowed. An empty list clears project-specific origins. Custom servers manage origins on their own infrastructure.
     *
     * @var list<string>|null $allowedOrigins
     */
    #[Optional('allowed_origins', list: 'string')]
    public ?array $allowedOrigins;

    /**
     * DefaultForDashboard selects this ready connection for Chunkify dashboard players, public previews, the playground and newly generated snippets. Requires a public ingest key. Setting true replaces the previous default atomically. Setting false disables dashboard tracking if no default remains; another connection is not selected automatically. Existing external players keep their own configuration.
     */
    #[Optional('default_for_dashboard')]
    public ?bool $defaultForDashboard;

    /**
     * Endpoint specifies a replacement custom server base URL. Supply read_key together with it.
     */
    #[Optional]
    public ?string $endpoint;

    /**
     * Name identifies this connection in the dashboard.
     */
    #[Optional]
    public ?string $name;

    /**
     * PublicIngestKey optionally enables preview tracking for a custom connection. Supply the public ingestion key for the same analytics project as read_key. It is returned in connection reads and used in browser code. Omit for hosted connections. An empty string disables preview tracking. A replacement endpoint clears the saved public key unless a replacement is supplied.
     */
    #[Optional('public_ingest_key')]
    public ?string $publicIngestKey;

    /**
     * ReadKey replaces the custom connection credential after validation. Its value is never returned.
     */
    #[Optional('read_key')]
    public ?string $readKey;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $allowedOrigins
     */
    public static function with(
        ?array $allowedOrigins = null,
        ?bool $defaultForDashboard = null,
        ?string $endpoint = null,
        ?string $name = null,
        ?string $publicIngestKey = null,
        ?string $readKey = null,
    ): self {
        $self = new self;

        null !== $allowedOrigins && $self['allowedOrigins'] = $allowedOrigins;
        null !== $defaultForDashboard && $self['defaultForDashboard'] = $defaultForDashboard;
        null !== $endpoint && $self['endpoint'] = $endpoint;
        null !== $name && $self['name'] = $name;
        null !== $publicIngestKey && $self['publicIngestKey'] = $publicIngestKey;
        null !== $readKey && $self['readKey'] = $readKey;

        return $self;
    }

    /**
     * AllowedOrigins lists additional website origins permitted to ingest events for a hosted connection. Shared installation origins remain allowed. An empty list clears project-specific origins. Custom servers manage origins on their own infrastructure.
     *
     * @param list<string> $allowedOrigins
     */
    public function withAllowedOrigins(array $allowedOrigins): self
    {
        $self = clone $this;
        $self['allowedOrigins'] = $allowedOrigins;

        return $self;
    }

    /**
     * DefaultForDashboard selects this ready connection for Chunkify dashboard players, public previews, the playground and newly generated snippets. Requires a public ingest key. Setting true replaces the previous default atomically. Setting false disables dashboard tracking if no default remains; another connection is not selected automatically. Existing external players keep their own configuration.
     */
    public function withDefaultForDashboard(bool $defaultForDashboard): self
    {
        $self = clone $this;
        $self['defaultForDashboard'] = $defaultForDashboard;

        return $self;
    }

    /**
     * Endpoint specifies a replacement custom server base URL. Supply read_key together with it.
     */
    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

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
     * PublicIngestKey optionally enables preview tracking for a custom connection. Supply the public ingestion key for the same analytics project as read_key. It is returned in connection reads and used in browser code. Omit for hosted connections. An empty string disables preview tracking. A replacement endpoint clears the saved public key unless a replacement is supplied.
     */
    public function withPublicIngestKey(string $publicIngestKey): self
    {
        $self = clone $this;
        $self['publicIngestKey'] = $publicIngestKey;

        return $self;
    }

    /**
     * ReadKey replaces the custom connection credential after validation. Its value is never returned.
     */
    public function withReadKey(string $readKey): self
    {
        $self = clone $this;
        $self['readKey'] = $readKey;

        return $self;
    }
}
