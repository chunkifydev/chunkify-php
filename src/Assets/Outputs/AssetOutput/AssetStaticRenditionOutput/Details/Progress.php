<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\AssetOutput\AssetStaticRenditionOutput\Details;

use Chunkify\Assets\Outputs\AssetOutput\AssetStaticRenditionOutput\Details\Progress\Stage;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Progress specifies the current processing stage and encoding percentage. Omitted after processing ends.
 *
 * @phpstan-type ProgressShape = array{
 *   stage: Stage|value-of<Stage>, percent?: float|null
 * }
 */
final class Progress implements BaseModel
{
    /** @use SdkModel<ProgressShape> */
    use SdkModel;

    /**
     * Stage specifies the current preparation activity. Finalization and streaming publication can overlap encoding; finalizing is shown once encoding has completed.
     *
     * @var value-of<Stage> $stage
     */
    #[Required(enum: Stage::class)]
    public string $stage;

    /**
     * Percent specifies the percentage of the video encoded so far. Present only during encoding when video duration is known. It may decrease if processing restarts. It does not estimate total preparation time.
     */
    #[Optional]
    public ?float $percent;

    /**
     * `new Progress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Progress::with(stage: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Progress)->withStage(...)
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
     * @param Stage|value-of<Stage> $stage
     */
    public static function with(
        Stage|string $stage,
        ?float $percent = null
    ): self {
        $self = new self;

        $self['stage'] = $stage;

        null !== $percent && $self['percent'] = $percent;

        return $self;
    }

    /**
     * Stage specifies the current preparation activity. Finalization and streaming publication can overlap encoding; finalizing is shown once encoding has completed.
     *
     * @param Stage|value-of<Stage> $stage
     */
    public function withStage(Stage|string $stage): self
    {
        $self = clone $this;
        $self['stage'] = $stage;

        return $self;
    }

    /**
     * Percent specifies the percentage of the video encoded so far. Present only during encoding when video duration is known. It may decrease if processing restarts. It does not estimate total preparation time.
     */
    public function withPercent(float $percent): self
    {
        $self = clone $this;
        $self['percent'] = $percent;

        return $self;
    }
}
