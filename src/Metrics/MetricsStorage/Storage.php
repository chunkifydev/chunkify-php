<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsStorage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Metrics\MetricsStorage\Storage\Daily;
use Chunkify\Metrics\MetricsStorage\Storage\Summary;

/**
 * Activity for one persistent storage configuration.
 *
 * @phpstan-import-type DailyShape from \Chunkify\Metrics\MetricsStorage\Storage\Daily
 * @phpstan-import-type SummaryShape from \Chunkify\Metrics\MetricsStorage\Storage\Summary
 *
 * @phpstan-type StorageShape = array{
 *   daily: list<Daily|DailyShape>,
 *   storageID: string,
 *   summary: Summary|SummaryShape,
 * }
 */
final class Storage implements BaseModel
{
    /** @use SdkModel<StorageShape> */
    use SdkModel;

    /**
     * Daily specifies one record for each selected event day, oldest first.
     *
     * @var list<Daily> $daily
     */
    #[Required(list: Daily::class)]
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
    public Summary $summary;

    /**
     * `new Storage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Storage::with(daily: ..., storageID: ..., summary: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Storage)->withDaily(...)->withStorageID(...)->withSummary(...)
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
     * @param list<Daily|DailyShape> $daily
     * @param Summary|SummaryShape $summary
     */
    public static function with(
        array $daily,
        string $storageID,
        Summary|array $summary
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
     * @param list<Daily|DailyShape> $daily
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
     * @param Summary|SummaryShape $summary
     */
    public function withSummary(Summary|array $summary): self
    {
        $self = clone $this;
        $self['summary'] = $summary;

        return $self;
    }
}
