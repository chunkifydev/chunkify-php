<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage\Daily;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Source ingestion activity.
 *
 * @phpstan-type SourcesShape = array{
 *   bytes: int, created: int, ingestedSeconds: int
 * }
 */
final class Sources implements BaseModel
{
    /** @use SdkModel<SourcesShape> */
    use SdkModel;

    /**
     * Bytes specifies cumulative ingested Source bytes, not current storage occupancy.
     */
    #[Required]
    public int $bytes;

    /**
     * Created specifies the number of ingested Sources.
     */
    #[Required]
    public int $created;

    /**
     * IngestedSeconds specifies ingested media duration in seconds.
     */
    #[Required('ingested_seconds')]
    public int $ingestedSeconds;

    /**
     * `new Sources()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Sources::with(bytes: ..., created: ..., ingestedSeconds: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Sources)->withBytes(...)->withCreated(...)->withIngestedSeconds(...)
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
    public static function with(
        int $bytes,
        int $created,
        int $ingestedSeconds
    ): self {
        $self = new self;

        $self['bytes'] = $bytes;
        $self['created'] = $created;
        $self['ingestedSeconds'] = $ingestedSeconds;

        return $self;
    }

    /**
     * Bytes specifies cumulative ingested Source bytes, not current storage occupancy.
     */
    public function withBytes(int $bytes): self
    {
        $self = clone $this;
        $self['bytes'] = $bytes;

        return $self;
    }

    /**
     * Created specifies the number of ingested Sources.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * IngestedSeconds specifies ingested media duration in seconds.
     */
    public function withIngestedSeconds(int $ingestedSeconds): self
    {
        $self = clone $this;
        $self['ingestedSeconds'] = $ingestedSeconds;

        return $self;
    }
}
