<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AnalyticsConnectionShape from \Chunkify\Projects\AnalyticsConnections\AnalyticsConnection
 *
 * @phpstan-type AnalyticsConnectionNewResponseShape = array{
 *   data: AnalyticsConnection|AnalyticsConnectionShape,
 *   status: 'success',
 *   publicKey?: string|null,
 * }
 */
final class AnalyticsConnectionNewResponse implements BaseModel
{
    /** @use SdkModel<AnalyticsConnectionNewResponseShape> */
    use SdkModel;

    /** @var 'success' $status */
    #[Required]
    public string $status = 'success';

    /**
     * A saved source for analytics reports. The dashboard player default is independent of the connection selected in reports. External players keep their own configuration. Only the public ingest key is included; read and management credentials stay private.
     */
    #[Required]
    public AnalyticsConnection $data;

    /**
     * PublicKey is the hosted ingestion key. It remains available as public_ingest_key on the connection. Omitted for custom connections.
     */
    #[Optional('public_key')]
    public ?string $publicKey;

    /**
     * `new AnalyticsConnectionNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AnalyticsConnectionNewResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AnalyticsConnectionNewResponse)->withData(...)
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
     * @param AnalyticsConnection|AnalyticsConnectionShape $data
     */
    public static function with(
        AnalyticsConnection|array $data,
        ?string $publicKey = null
    ): self {
        $self = new self;

        $self['data'] = $data;

        null !== $publicKey && $self['publicKey'] = $publicKey;

        return $self;
    }

    /**
     * A saved source for analytics reports. The dashboard player default is independent of the connection selected in reports. External players keep their own configuration. Only the public ingest key is included; read and management credentials stay private.
     *
     * @param AnalyticsConnection|AnalyticsConnectionShape $data
     */
    public function withData(AnalyticsConnection|array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param 'success' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * PublicKey is the hosted ingestion key. It remains available as public_ingest_key on the connection. Omitted for custom connections.
     */
    public function withPublicKey(string $publicKey): self
    {
        $self = clone $this;
        $self['publicKey'] = $publicKey;

        return $self;
    }
}
