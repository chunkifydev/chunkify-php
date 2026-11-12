<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsAssets\Summary;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Asset outcomes grouped by Asset creation date.
 *
 * @phpstan-type AssetsShape = array{
 *   completed: int, failed: int, processedSeconds: float, saved: int
 * }
 */
final class Assets implements BaseModel
{
    /** @use SdkModel<AssetsShape> */
    use SdkModel;

    /**
     * Completed specifies Assets with a recorded ready timestamp.
     */
    #[Required]
    public int $completed;

    /**
     * Failed specifies retained Assets currently in failed status.
     */
    #[Required]
    public int $failed;

    /**
     * ProcessedSeconds specifies measured media duration of completed Assets, preserving fractional seconds.
     */
    #[Required('processed_seconds')]
    public float $processedSeconds;

    /**
     * Saved specifies retained Assets created in the period.
     */
    #[Required]
    public int $saved;

    /**
     * `new Assets()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Assets::with(completed: ..., failed: ..., processedSeconds: ..., saved: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Assets)
     *   ->withCompleted(...)
     *   ->withFailed(...)
     *   ->withProcessedSeconds(...)
     *   ->withSaved(...)
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
        int $completed,
        int $failed,
        float $processedSeconds,
        int $saved
    ): self {
        $self = new self;

        $self['completed'] = $completed;
        $self['failed'] = $failed;
        $self['processedSeconds'] = $processedSeconds;
        $self['saved'] = $saved;

        return $self;
    }

    /**
     * Completed specifies Assets with a recorded ready timestamp.
     */
    public function withCompleted(int $completed): self
    {
        $self = clone $this;
        $self['completed'] = $completed;

        return $self;
    }

    /**
     * Failed specifies retained Assets currently in failed status.
     */
    public function withFailed(int $failed): self
    {
        $self = clone $this;
        $self['failed'] = $failed;

        return $self;
    }

    /**
     * ProcessedSeconds specifies measured media duration of completed Assets, preserving fractional seconds.
     */
    public function withProcessedSeconds(float $processedSeconds): self
    {
        $self = clone $this;
        $self['processedSeconds'] = $processedSeconds;

        return $self;
    }

    /**
     * Saved specifies retained Assets created in the period.
     */
    public function withSaved(int $saved): self
    {
        $self = clone $this;
        $self['saved'] = $saved;

        return $self;
    }
}
