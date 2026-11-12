<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Metrics\MetricStorageParams\Format;

/**
 * Retrieve recorded additions and successful removals by storage and UTC date. Historical coverage depends on event retention.
 *
 * @see Chunkify\Services\MetricsService::storage()
 *
 * @phpstan-type MetricStorageParamsShape = array{
 *   format?: null|Format|value-of<Format>,
 *   from?: string|null,
 *   storageID?: string|null,
 *   to?: string|null,
 * }
 */
final class MetricStorageParams implements BaseModel
{
    /** @use SdkModel<MetricStorageParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Response format. Defaults to JSON unless Accept requests CSV. Overrides Accept when supplied; errors remain JSON.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    /**
     * Inclusive UTC start date, YYYY-MM-DD. Supply both dates for a custom range of at most 366 days. Omit both for the past 7 UTC calendar days including today.
     */
    #[Optional]
    public ?string $from;

    /**
     * Filter to one persistent storage configuration in the authenticated project.
     */
    #[Optional]
    public ?string $storageID;

    /**
     * Exclusive UTC end date, YYYY-MM-DD. Must be after from and at most 366 days later.
     */
    #[Optional]
    public ?string $to;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Format|value-of<Format>|null $format
     */
    public static function with(
        Format|string|null $format = null,
        ?string $from = null,
        ?string $storageID = null,
        ?string $to = null,
    ): self {
        $self = new self;

        null !== $format && $self['format'] = $format;
        null !== $from && $self['from'] = $from;
        null !== $storageID && $self['storageID'] = $storageID;
        null !== $to && $self['to'] = $to;

        return $self;
    }

    /**
     * Response format. Defaults to JSON unless Accept requests CSV. Overrides Accept when supplied; errors remain JSON.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * Inclusive UTC start date, YYYY-MM-DD. Supply both dates for a custom range of at most 366 days. Omit both for the past 7 UTC calendar days including today.
     */
    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Filter to one persistent storage configuration in the authenticated project.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Exclusive UTC end date, YYYY-MM-DD. Must be after from and at most 366 days later.
     */
    public function withTo(string $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
