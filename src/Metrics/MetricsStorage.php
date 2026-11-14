<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Recorded additions and successful removals within event retention. Excludes external storage changes and does not measure current storage size.
 *
 * @phpstan-import-type MetricsStorageEntryShape from \Chunkify\Metrics\MetricsStorageEntry
 *
 * @phpstan-type MetricsStorageShape = array{
 *   from: string,
 *   storages: list<MetricsStorageEntry|MetricsStorageEntryShape>,
 *   to: string,
 * }
 */
final class MetricsStorage implements BaseModel
{
    /** @use SdkModel<MetricsStorageShape> */
    use SdkModel;

    /**
     * From specifies the inclusive UTC start date.
     */
    #[Required]
    public string $from;

    /**
     * Storages specifies persistent project storage configurations, including those without recorded activity. Chunkify temporary storage is excluded.
     *
     * @var list<MetricsStorageEntry> $storages
     */
    #[Required(list: MetricsStorageEntry::class)]
    public array $storages;

    /**
     * To specifies the exclusive UTC end date.
     */
    #[Required]
    public string $to;

    /**
     * `new MetricsStorage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsStorage::with(from: ..., storages: ..., to: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsStorage)->withFrom(...)->withStorages(...)->withTo(...)
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
     * @param list<MetricsStorageEntry|MetricsStorageEntryShape> $storages
     */
    public static function with(string $from, array $storages, string $to): self
    {
        $self = new self;

        $self['from'] = $from;
        $self['storages'] = $storages;
        $self['to'] = $to;

        return $self;
    }

    /**
     * From specifies the inclusive UTC start date.
     */
    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * Storages specifies persistent project storage configurations, including those without recorded activity. Chunkify temporary storage is excluded.
     *
     * @param list<MetricsStorageEntry|MetricsStorageEntryShape> $storages
     */
    public function withStorages(array $storages): self
    {
        $self = clone $this;
        $self['storages'] = $storages;

        return $self;
    }

    /**
     * To specifies the exclusive UTC end date.
     */
    public function withTo(string $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }
}
