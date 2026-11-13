<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Asset processing usage.
 *
 * @phpstan-type MetricsUsageAssetsShape = array{
 *   failed: int,
 *   inputSeconds: int,
 *   inputSecondsByResolution: array<string,int>,
 *   ready: int,
 * }
 */
final class MetricsUsageAssets implements BaseModel
{
    /** @use SdkModel<MetricsUsageAssetsShape> */
    use SdkModel;

    /**
     * Failed specifies recorded failed Asset outcomes.
     */
    #[Required]
    public int $failed;

    /**
     * InputSeconds specifies settled billable Asset input duration.
     */
    #[Required('input_seconds')]
    public int $inputSeconds;

    /**
     * Video duration in seconds by pricing resolution tier: sd, hd, 2k and uhd.
     *
     * @var array<string,int> $inputSecondsByResolution
     */
    #[Required('input_seconds_by_resolution', map: 'int')]
    public array $inputSecondsByResolution;

    /**
     * Ready specifies recorded successful Asset outcomes.
     */
    #[Required]
    public int $ready;

    /**
     * `new MetricsUsageAssets()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsUsageAssets::with(
     *   failed: ..., inputSeconds: ..., inputSecondsByResolution: ..., ready: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsUsageAssets)
     *   ->withFailed(...)
     *   ->withInputSeconds(...)
     *   ->withInputSecondsByResolution(...)
     *   ->withReady(...)
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
     * @param array<string,int> $inputSecondsByResolution
     */
    public static function with(
        int $failed,
        int $inputSeconds,
        array $inputSecondsByResolution,
        int $ready
    ): self {
        $self = new self;

        $self['failed'] = $failed;
        $self['inputSeconds'] = $inputSeconds;
        $self['inputSecondsByResolution'] = $inputSecondsByResolution;
        $self['ready'] = $ready;

        return $self;
    }

    /**
     * Failed specifies recorded failed Asset outcomes.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * InputSeconds specifies settled billable Asset input duration.
     */
    public function withInputSeconds(int $inputSeconds): self
    {
        $self = clone $this;
        $self['inputSeconds'] = $inputSeconds;

        return $self;
    }

    /**
     * Video duration in seconds by pricing resolution tier: sd, hd, 2k and uhd.
     *
     * @param array<string,int> $inputSecondsByResolution
     */
    public function withInputSecondsByResolution(
        array $inputSecondsByResolution
    ): self {
        $self = clone $this;
        $self['inputSecondsByResolution'] = $inputSecondsByResolution;

        return $self;
    }

    /**
     * Ready specifies recorded successful Asset outcomes.
     */
    public function withReady(int $ready): self
    {
        $self = clone $this;
        $self['ready'] = $ready;

        return $self;
    }
}
