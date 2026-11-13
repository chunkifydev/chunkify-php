<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Activity for one persistent storage configuration.
 *
 * @phpstan-import-type MetricsStorageDayShape from \Chunkify\Metrics\MetricsStorageDay
 * @phpstan-import-type MetricsStorageValuesShape from \Chunkify\Metrics\MetricsStorageValues
 *
 * @phpstan-type MetricsStorageEntryShape = array{
 *   daily: list<MetricsStorageDay|MetricsStorageDayShape>,
 *   storageID: string,
 *   summary: MetricsStorageValues|MetricsStorageValuesShape,
 * }
 */
final class MetricsStorageEntry implements BaseModel
{
    /** @use SdkModel<MetricsStorageEntryShape> */
    use SdkModel;

    /**
     * Daily specifies one record for each selected event day, oldest first.
     *
     * @var list<MetricsStorageDay> $daily
     */
    #[Required(list: MetricsStorageDay::class)]
    public array $daily;

    /**
     * StorageId identifies the persistent storage configuration.
     */
    #[Required('storage_id')]
    public string $storageID;

    /**
     * Summary specifies recorded activity in the selected period.
     */
    #[Required]
    public MetricsStorageValues $summary;

    /**
     * `new MetricsStorageEntry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsStorageEntry::with(daily: ..., storageID: ..., summary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsStorageEntry)->withDaily(...)->withStorageID(...)->withSummary(...)
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
     * @param list<MetricsStorageDay|MetricsStorageDayShape> $daily
     * @param MetricsStorageValues|MetricsStorageValuesShape $summary
     */
    public static function with(
        array $daily,
        string $storageID,
        MetricsStorageValues|array $summary
    ): self {
        $self = new self;

        $self['daily'] = $daily;
        $self['storageID'] = $storageID;
        $self['summary'] = $summary;

        return $self;
    }

    /**
     * Daily specifies one record for each selected event day, oldest first.
     *
     * @param list<MetricsStorageDay|MetricsStorageDayShape> $daily
     */
    public function withDaily(array $daily): self
    {
        $self = clone $this;
        $self['daily'] = $daily;

        return $self;
    }

    /**
     * StorageId identifies the persistent storage configuration.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Summary specifies recorded activity in the selected period.
     *
     * @param MetricsStorageValues|MetricsStorageValuesShape $summary
     */
    public function withSummary(MetricsStorageValues|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
