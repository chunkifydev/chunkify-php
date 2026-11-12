<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnection\Status;
use Chunkify\Projects\AnalyticsConnections\AnalyticsConnection\Type;

/**
 * A saved source for analytics reports. The dashboard player default is independent of the connection selected in reports. External players keep their own configuration. Only the public ingest key is included; read and management credentials stay private.
 *
 * @phpstan-type AnalyticsConnectionShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   defaultForDashboard: bool,
 *   endpoint: string,
 *   name: string,
 *   projectID: string,
 *   status: Status|value-of<Status>,
 *   type: Type|value-of<Type>,
 *   updatedAt: \DateTimeInterface,
 *   allowedOrigins?: list<string>|null,
 *   lastCheckedAt?: \DateTimeInterface|null,
 *   publicIngestKey?: string|null,
 *   retentionSeconds?: int|null,
 * }
 */
final class AnalyticsConnection implements BaseModel
{
    /** @use SdkModel<AnalyticsConnectionShape> */
    use SdkModel;

    /**
     * Id identifies this saved analytics connection.
     */
    #[Required]
    public string $id;

    /**
     * CreatedAt records when this connection was added.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * DefaultForDashboard selects this connection for Chunkify dashboard players, public previews, the playground and newly generated snippets. It does not change existing external players. At most one connection per project is selected.
     */
    #[Required('default_for_dashboard')]
    public bool $defaultForDashboard;

    /**
     * Endpoint specifies the analytics server base URL. It does not configure the player.
     */
    #[Required]
    public string $endpoint;

    /**
     * Name identifies this connection in the dashboard.
     */
    #[Required]
    public string $name;

    /**
     * ProjectId identifies the owning Chunkify project.
     */
    #[Required('project_id')]
    public string $projectID;

    /**
     * Status indicates whether the connection is ready to read or requires setup repair.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Type specifies whether Chunkify manages the analytics project.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * UpdatedAt records when this connection was last changed.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * AllowedOrigins lists additional website origins permitted to ingest events for a hosted connection. Shared installation origins remain allowed. An empty list clears project-specific origins. Custom servers manage origins on their own infrastructure.
     *
     * @var list<string>|null $allowedOrigins
     */
    #[Optional('allowed_origins', list: 'string')]
    public ?array $allowedOrigins;

    /**
     * LastCheckedAt records the most recent successful connection check.
     */
    #[Optional('last_checked_at')]
    public ?\DateTimeInterface $lastCheckedAt;

    /**
     * PublicIngestKey is the public browser ingestion key used by Chunkify previews and player examples. It cannot read or manage analytics. Hosted connections use their primary public key. Omitted when preview tracking is not configured.
     */
    #[Optional('public_ingest_key')]
    public ?string $publicIngestKey;

    /**
     * RetentionSeconds is the last retention applied to a hosted project, in seconds. Omitted for custom connections.
     */
    #[Optional('retention_seconds')]
    public ?int $retentionSeconds;

    /**
     * `new AnalyticsConnection()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AnalyticsConnection::with(
     *   id: ...,
     *   createdAt: ...,
     *   defaultForDashboard: ...,
     *   endpoint: ...,
     *   name: ...,
     *   projectID: ...,
     *   status: ...,
     *   type: ...,
     *   updatedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AnalyticsConnection)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDefaultForDashboard(...)
     *   ->withEndpoint(...)
     *   ->withName(...)
     *   ->withProjectID(...)
     *   ->withStatus(...)
     *   ->withType(...)
     *   ->withUpdatedAt(...)
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
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     * @param list<string>|null $allowedOrigins
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        bool $defaultForDashboard,
        string $endpoint,
        string $name,
        string $projectID,
        Status|string $status,
        Type|string $type,
        \DateTimeInterface $updatedAt,
        ?array $allowedOrigins = null,
        ?\DateTimeInterface $lastCheckedAt = null,
        ?string $publicIngestKey = null,
        ?int $retentionSeconds = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['defaultForDashboard'] = $defaultForDashboard;
        $self['endpoint'] = $endpoint;
        $self['name'] = $name;
        $self['projectID'] = $projectID;
        $self['status'] = $status;
        $self['type'] = $type;
        $self['updatedAt'] = $updatedAt;

        null !== $allowedOrigins && $self['allowedOrigins'] = $allowedOrigins;
        null !== $lastCheckedAt && $self['lastCheckedAt'] = $lastCheckedAt;
        null !== $publicIngestKey && $self['publicIngestKey'] = $publicIngestKey;
        null !== $retentionSeconds && $self['retentionSeconds'] = $retentionSeconds;

        return $self;
    }

    /**
     * Id identifies this saved analytics connection.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * CreatedAt records when this connection was added.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * DefaultForDashboard selects this connection for Chunkify dashboard players, public previews, the playground and newly generated snippets. It does not change existing external players. At most one connection per project is selected.
     */
    public function withDefaultForDashboard(bool $defaultForDashboard): self
    {
        $self = clone $this;
        $self['defaultForDashboard'] = $defaultForDashboard;

        return $self;
    }

    /**
     * Endpoint specifies the analytics server base URL. It does not configure the player.
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
     * ProjectId identifies the owning Chunkify project.
     */
    public function withProjectID(string $projectID): self
    {
        $self = clone $this;
        $self['projectID'] = $projectID;

        return $self;
    }

    /**
     * Status indicates whether the connection is ready to read or requires setup repair.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

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
     * UpdatedAt records when this connection was last changed.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

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
     * LastCheckedAt records the most recent successful connection check.
     */
    public function withLastCheckedAt(\DateTimeInterface $lastCheckedAt): self
    {
        $self = clone $this;
        $self['lastCheckedAt'] = $lastCheckedAt;

        return $self;
    }

    /**
     * PublicIngestKey is the public browser ingestion key used by Chunkify previews and player examples. It cannot read or manage analytics. Hosted connections use their primary public key. Omitted when preview tracking is not configured.
     */
    public function withPublicIngestKey(string $publicIngestKey): self
    {
        $self = clone $this;
        $self['publicIngestKey'] = $publicIngestKey;

        return $self;
    }

    /**
     * RetentionSeconds is the last retention applied to a hosted project, in seconds. Omitted for custom connections.
     */
    public function withRetentionSeconds(int $retentionSeconds): self
    {
        $self = clone $this;
        $self['retentionSeconds'] = $retentionSeconds;

        return $self;
    }
}
