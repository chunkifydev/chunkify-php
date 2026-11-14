<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Settled credits in integer units, with 10000 units equal to USD 1 of credits. Category values are parts of total, not additional charges.
 *
 * @phpstan-type MetricsCreditsSpentShape = array{
 *   assets: int,
 *   egress: int,
 *   staticRenditions: int,
 *   thumbnails: int,
 *   total: int,
 *   transcodings: int,
 *   transcription: int,
 *   translation: int,
 * }
 */
final class MetricsCreditsSpent implements BaseModel
{
    /** @use SdkModel<MetricsCreditsSpentShape> */
    use SdkModel;

    /**
     * Amount specifies settled credits spent on assets. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required]
    public int $assets;

    /**
     * Amount specifies settled credits spent on egress. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required]
    public int $egress;

    /**
     * Amount specifies settled credits spent on static renditions. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required('static_renditions')]
    public int $staticRenditions;

    /**
     * Amount specifies settled credits spent on thumbnails. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required]
    public int $thumbnails;

    /**
     * Total specifies the sum of these media-processing and output-egress charges. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required]
    public int $total;

    /**
     * Amount specifies settled credits spent on transcodings. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required]
    public int $transcodings;

    /**
     * Amount specifies settled credits spent on transcription. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required]
    public int $transcription;

    /**
     * Amount specifies settled credits spent on translation. Integer units; 10000 units equal USD 1 of credits.
     */
    #[Required]
    public int $translation;

    /**
     * `new MetricsCreditsSpent()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsCreditsSpent::with(
     *   assets: ...,
     *   egress: ...,
     *   staticRenditions: ...,
     *   thumbnails: ...,
     *   total: ...,
     *   transcodings: ...,
     *   transcription: ...,
     *   translation: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsCreditsSpent)
     *   ->withAssets(...)
     *   ->withEgress(...)
     *   ->withStaticRenditions(...)
     *   ->withThumbnails(...)
     *   ->withTotal(...)
     *   ->withTranscodings(...)
     *   ->withTranscription(...)
     *   ->withTranslation(...)
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
        int $assets,
        int $egress,
        int $staticRenditions,
        int $thumbnails,
        int $total,
        int $transcodings,
        int $transcription,
        int $translation,
    ): self {
        $self = new self;

        $self['assets'] = $assets;
        $self['egress'] = $egress;
        $self['staticRenditions'] = $staticRenditions;
        $self['thumbnails'] = $thumbnails;
        $self['total'] = $total;
        $self['transcodings'] = $transcodings;
        $self['transcription'] = $transcription;
        $self['translation'] = $translation;

        return $self;
    }

    /**
     * Amount specifies settled credits spent on assets. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withAssets(int $assets): self
    {
        $self = clone $this;
        $self['assets'] = $assets;

        return $self;
    }

    /**
     * Amount specifies settled credits spent on egress. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withEgress(int $egress): self
    {
        $self = clone $this;
        $self['egress'] = $egress;

        return $self;
    }

    /**
     * Amount specifies settled credits spent on static renditions. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withStaticRenditions(int $staticRenditions): self
    {
        $self = clone $this;
        $self['staticRenditions'] = $staticRenditions;

        return $self;
    }

    /**
     * Amount specifies settled credits spent on thumbnails. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withThumbnails(int $thumbnails): self
    {
        $self = clone $this;
        $self['thumbnails'] = $thumbnails;

        return $self;
    }

    /**
     * Total specifies the sum of these media-processing and output-egress charges. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }

    /**
     * Amount specifies settled credits spent on transcodings. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withTranscodings(int $transcodings): self
    {
        $self = clone $this;
        $self['transcodings'] = $transcodings;

        return $self;
    }

    /**
     * Amount specifies settled credits spent on transcription. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withTranscription(int $transcription): self
    {
        $self = clone $this;
        $self['transcription'] = $transcription;

        return $self;
    }

    /**
     * Amount specifies settled credits spent on translation. Integer units; 10000 units equal USD 1 of credits.
     */
    public function withTranslation(int $translation): self
    {
        $self = clone $this;
        $self['translation'] = $translation;

        return $self;
    }
}
