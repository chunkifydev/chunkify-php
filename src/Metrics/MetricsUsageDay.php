<?php

declare(strict_types=1);

namespace Chunkify\Metrics;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Daily recorded usage. Inactive days contain zero counters.
 *
 * @phpstan-import-type MetricsUsageAssetsShape from \Chunkify\Metrics\MetricsUsageAssets
 * @phpstan-import-type MetricsUsageCaptionsShape from \Chunkify\Metrics\MetricsUsageCaptions
 * @phpstan-import-type MetricsCreditsSpentShape from \Chunkify\Metrics\MetricsCreditsSpent
 * @phpstan-import-type MetricsUsageEgressShape from \Chunkify\Metrics\MetricsUsageEgress
 * @phpstan-import-type MetricsUsageNotificationsShape from \Chunkify\Metrics\MetricsUsageNotifications
 * @phpstan-import-type MetricsUsageSourcesShape from \Chunkify\Metrics\MetricsUsageSources
 * @phpstan-import-type MetricsUsageStaticRenditionsShape from \Chunkify\Metrics\MetricsUsageStaticRenditions
 * @phpstan-import-type MetricsUsageThumbnailsShape from \Chunkify\Metrics\MetricsUsageThumbnails
 * @phpstan-import-type MetricsUsageTranscodingsShape from \Chunkify\Metrics\MetricsUsageTranscodings
 * @phpstan-import-type MetricsUsageUploadsShape from \Chunkify\Metrics\MetricsUsageUploads
 *
 * @phpstan-type MetricsUsageDayShape = array{
 *   assets: MetricsUsageAssets|MetricsUsageAssetsShape,
 *   captions: MetricsUsageCaptions|MetricsUsageCaptionsShape,
 *   creditsSpent: MetricsCreditsSpent|MetricsCreditsSpentShape,
 *   egress: MetricsUsageEgress|MetricsUsageEgressShape,
 *   notifications: MetricsUsageNotifications|MetricsUsageNotificationsShape,
 *   sources: MetricsUsageSources|MetricsUsageSourcesShape,
 *   staticRenditions: MetricsUsageStaticRenditions|MetricsUsageStaticRenditionsShape,
 *   thumbnails: MetricsUsageThumbnails|MetricsUsageThumbnailsShape,
 *   transcodings: MetricsUsageTranscodings|MetricsUsageTranscodingsShape,
 *   uploads: MetricsUsageUploads|MetricsUsageUploadsShape,
 *   date: string,
 * }
 */
final class MetricsUsageDay implements BaseModel
{
    /** @use SdkModel<MetricsUsageDayShape> */
    use SdkModel;

    /**
     * Asset processing usage.
     */
    #[Required]
    public MetricsUsageAssets $assets;

    /**
     * Caption processing usage.
     */
    #[Required]
    public MetricsUsageCaptions $captions;

    /**
     * Settled credits in integer units, with 10000 units equal to USD 1 of credits. Category values are parts of total, not additional charges.
     */
    #[Required('credits_spent')]
    public MetricsCreditsSpent $creditsSpent;

    /**
     * Recorded output egress eligible for the transfer tariff. Provider-exempt transfers are excluded.
     */
    #[Required]
    public MetricsUsageEgress $egress;

    /**
     * Webhook delivery activity.
     */
    #[Required]
    public MetricsUsageNotifications $notifications;

    /**
     * Source ingestion activity.
     */
    #[Required]
    public MetricsUsageSources $sources;

    /**
     * Static rendition usage.
     */
    #[Required('static_renditions')]
    public MetricsUsageStaticRenditions $staticRenditions;

    /**
     * Thumbnail processing usage.
     */
    #[Required]
    public MetricsUsageThumbnails $thumbnails;

    /**
     * Standalone Transcoding usage.
     */
    #[Required]
    public MetricsUsageTranscodings $transcodings;

    /**
     * Upload activity.
     */
    #[Required]
    public MetricsUsageUploads $uploads;

    /**
     * Date specifies the UTC accounting day.
     */
    #[Required]
    public string $date;

    /**
     * `new MetricsUsageDay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MetricsUsageDay::with(
     *   assets: ...,
     *   captions: ...,
     *   creditsSpent: ...,
     *   egress: ...,
     *   notifications: ...,
     *   sources: ...,
     *   staticRenditions: ...,
     *   thumbnails: ...,
     *   transcodings: ...,
     *   uploads: ...,
     *   date: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MetricsUsageDay)
     *   ->withAssets(...)
     *   ->withCaptions(...)
     *   ->withCreditsSpent(...)
     *   ->withEgress(...)
     *   ->withNotifications(...)
     *   ->withSources(...)
     *   ->withStaticRenditions(...)
     *   ->withThumbnails(...)
     *   ->withTranscodings(...)
     *   ->withUploads(...)
     *   ->withDate(...)
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
     * @param MetricsUsageAssets|MetricsUsageAssetsShape $assets
     * @param MetricsUsageCaptions|MetricsUsageCaptionsShape $captions
     * @param MetricsCreditsSpent|MetricsCreditsSpentShape $creditsSpent
     * @param MetricsUsageEgress|MetricsUsageEgressShape $egress
     * @param MetricsUsageNotifications|MetricsUsageNotificationsShape $notifications
     * @param MetricsUsageSources|MetricsUsageSourcesShape $sources
     * @param MetricsUsageStaticRenditions|MetricsUsageStaticRenditionsShape $staticRenditions
     * @param MetricsUsageThumbnails|MetricsUsageThumbnailsShape $thumbnails
     * @param MetricsUsageTranscodings|MetricsUsageTranscodingsShape $transcodings
     * @param MetricsUsageUploads|MetricsUsageUploadsShape $uploads
     */
    public static function with(
        MetricsUsageAssets|array $assets,
        MetricsUsageCaptions|array $captions,
        MetricsCreditsSpent|array $creditsSpent,
        MetricsUsageEgress|array $egress,
        MetricsUsageNotifications|array $notifications,
        MetricsUsageSources|array $sources,
        MetricsUsageStaticRenditions|array $staticRenditions,
        MetricsUsageThumbnails|array $thumbnails,
        MetricsUsageTranscodings|array $transcodings,
        MetricsUsageUploads|array $uploads,
        string $date,
    ): self {
        $self = new self;

        $self['assets'] = $assets;
        $self['captions'] = $captions;
        $self['creditsSpent'] = $creditsSpent;
        $self['egress'] = $egress;
        $self['notifications'] = $notifications;
        $self['sources'] = $sources;
        $self['staticRenditions'] = $staticRenditions;
        $self['thumbnails'] = $thumbnails;
        $self['transcodings'] = $transcodings;
        $self['uploads'] = $uploads;
        $self['date'] = $date;

        return $self;
    }

    /**
     * Asset processing usage.
     *
     * @param MetricsUsageAssets|MetricsUsageAssetsShape $assets
     */
    public function withAssets(MetricsUsageAssets|array $assets): self
    {
        $self = clone $this;
        $self['assets'] = $assets;

        return $self;
    }

    /**
     * Caption processing usage.
     *
     * @param MetricsUsageCaptions|MetricsUsageCaptionsShape $captions
     */
    public function withCaptions(MetricsUsageCaptions|array $captions): self
    {
        $self = clone $this;
        $self['captions'] = $captions;

        return $self;
    }

    /**
     * Settled credits in integer units, with 10000 units equal to USD 1 of credits. Category values are parts of total, not additional charges.
     *
     * @param MetricsCreditsSpent|MetricsCreditsSpentShape $creditsSpent
     */
    public function withCreditsSpent(
        MetricsCreditsSpent|array $creditsSpent
    ): self {
        $self = clone $this;
        $self['creditsSpent'] = $creditsSpent;

        return $self;
    }

    /**
     * Recorded output egress eligible for the transfer tariff. Provider-exempt transfers are excluded.
     *
     * @param MetricsUsageEgress|MetricsUsageEgressShape $egress
     */
    public function withEgress(MetricsUsageEgress|array $egress): self
    {
        $self = clone $this;
        $self['egress'] = $egress;

        return $self;
    }

    /**
     * Webhook delivery activity.
     *
     * @param MetricsUsageNotifications|MetricsUsageNotificationsShape $notifications
     */
    public function withNotifications(
        MetricsUsageNotifications|array $notifications
    ): self {
        $self = clone $this;
        $self['notifications'] = $notifications;

        return $self;
    }

    /**
     * Source ingestion activity.
     *
     * @param MetricsUsageSources|MetricsUsageSourcesShape $sources
     */
    public function withSources(MetricsUsageSources|array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    /**
     * Static rendition usage.
     *
     * @param MetricsUsageStaticRenditions|MetricsUsageStaticRenditionsShape $staticRenditions
     */
    public function withStaticRenditions(
        MetricsUsageStaticRenditions|array $staticRenditions
    ): self {
        $self = clone $this;
        $self['staticRenditions'] = $staticRenditions;

        return $self;
    }

    /**
     * Thumbnail processing usage.
     *
     * @param MetricsUsageThumbnails|MetricsUsageThumbnailsShape $thumbnails
     */
    public function withThumbnails(
        MetricsUsageThumbnails|array $thumbnails
    ): self {
        $self = clone $this;
        $self['thumbnails'] = $thumbnails;

        return $self;
    }

    /**
     * Standalone Transcoding usage.
     *
     * @param MetricsUsageTranscodings|MetricsUsageTranscodingsShape $transcodings
     */
    public function withTranscodings(
        MetricsUsageTranscodings|array $transcodings
    ): self {
        $self = clone $this;
        $self['transcodings'] = $transcodings;

        return $self;
    }

    /**
     * Upload activity.
     *
     * @param MetricsUsageUploads|MetricsUsageUploadsShape $uploads
     */
    public function withUploads(MetricsUsageUploads|array $uploads): self
    {
        $self = clone $this;
        $self['uploads'] = $uploads;

        return $self;
    }

    /**
     * Date specifies the UTC accounting day.
     */
    public function withDate(string $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }
}
