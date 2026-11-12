<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Metrics\MetricsUsage\Daily\Assets;
use Chunkify\Metrics\MetricsUsage\Daily\Captions;
use Chunkify\Metrics\MetricsUsage\Daily\CreditsSpent;
use Chunkify\Metrics\MetricsUsage\Daily\Egress;
use Chunkify\Metrics\MetricsUsage\Daily\Notifications;
use Chunkify\Metrics\MetricsUsage\Daily\Sources;
use Chunkify\Metrics\MetricsUsage\Daily\StaticRenditions;
use Chunkify\Metrics\MetricsUsage\Daily\Thumbnails;
use Chunkify\Metrics\MetricsUsage\Daily\Transcodings;
use Chunkify\Metrics\MetricsUsage\Daily\Uploads;

/**
 * Daily recorded usage. Inactive days contain zero counters.
 *
 * @phpstan-import-type AssetsShape from \Chunkify\Metrics\MetricsUsage\Daily\Assets
 * @phpstan-import-type CaptionsShape from \Chunkify\Metrics\MetricsUsage\Daily\Captions
 * @phpstan-import-type CreditsSpentShape from \Chunkify\Metrics\MetricsUsage\Daily\CreditsSpent
 * @phpstan-import-type EgressShape from \Chunkify\Metrics\MetricsUsage\Daily\Egress
 * @phpstan-import-type NotificationsShape from \Chunkify\Metrics\MetricsUsage\Daily\Notifications
 * @phpstan-import-type SourcesShape from \Chunkify\Metrics\MetricsUsage\Daily\Sources
 * @phpstan-import-type StaticRenditionsShape from \Chunkify\Metrics\MetricsUsage\Daily\StaticRenditions
 * @phpstan-import-type ThumbnailsShape from \Chunkify\Metrics\MetricsUsage\Daily\Thumbnails
 * @phpstan-import-type TranscodingsShape from \Chunkify\Metrics\MetricsUsage\Daily\Transcodings
 * @phpstan-import-type UploadsShape from \Chunkify\Metrics\MetricsUsage\Daily\Uploads
 *
 * @phpstan-type DailyShape = array{
 *   assets: Assets|AssetsShape,
 *   captions: Captions|CaptionsShape,
 *   creditsSpent: CreditsSpent|CreditsSpentShape,
 *   date: string,
 *   egress: Egress|EgressShape,
 *   notifications: Notifications|NotificationsShape,
 *   sources: Sources|SourcesShape,
 *   staticRenditions: StaticRenditions|StaticRenditionsShape,
 *   thumbnails: Thumbnails|ThumbnailsShape,
 *   transcodings: Transcodings|TranscodingsShape,
 *   uploads: Uploads|UploadsShape,
 * }
 */
final class Daily implements BaseModel
{
    /** @use SdkModel<DailyShape> */
    use SdkModel;

    /**
     * Asset processing usage.
     */
    #[Required]
    public Assets $assets;

    /**
     * Caption processing usage.
     */
    #[Required]
    public Captions $captions;

    /**
     * Settled credits in integer units, with 10000 units equal to USD 1 of credits. Category values are parts of total, not additional charges.
     */
    #[Required('credits_spent')]
    public CreditsSpent $creditsSpent;

    /**
     * Date specifies the UTC accounting day.
     */
    #[Required]
    public string $date;

    /**
     * Recorded output egress eligible for the transfer tariff. Provider-exempt transfers are excluded.
     */
    #[Required]
    public Egress $egress;

    /**
     * Webhook delivery activity.
     */
    #[Required]
    public Notifications $notifications;

    /**
     * Source ingestion activity.
     */
    #[Required]
    public Sources $sources;

    /**
     * Static rendition usage.
     */
    #[Required('static_renditions')]
    public StaticRenditions $staticRenditions;

    /**
     * Thumbnail processing usage.
     */
    #[Required]
    public Thumbnails $thumbnails;

    /**
     * Standalone Transcoding usage.
     */
    #[Required]
    public Transcodings $transcodings;

    /**
     * Upload activity.
     */
    #[Required]
    public Uploads $uploads;

    /**
     * `new Daily()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Daily::with(
     *   assets: ...,
     *   captions: ...,
     *   creditsSpent: ...,
     *   date: ...,
     *   egress: ...,
     *   notifications: ...,
     *   sources: ...,
     *   staticRenditions: ...,
     *   thumbnails: ...,
     *   transcodings: ...,
     *   uploads: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Daily)
     *   ->withAssets(...)
     *   ->withCaptions(...)
     *   ->withCreditsSpent(...)
     *   ->withDate(...)
     *   ->withEgress(...)
     *   ->withNotifications(...)
     *   ->withSources(...)
     *   ->withStaticRenditions(...)
     *   ->withThumbnails(...)
     *   ->withTranscodings(...)
     *   ->withUploads(...)
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
     * @param Assets|AssetsShape $assets
     * @param Captions|CaptionsShape $captions
     * @param CreditsSpent|CreditsSpentShape $creditsSpent
     * @param Egress|EgressShape $egress
     * @param Notifications|NotificationsShape $notifications
     * @param Sources|SourcesShape $sources
     * @param StaticRenditions|StaticRenditionsShape $staticRenditions
     * @param Thumbnails|ThumbnailsShape $thumbnails
     * @param Transcodings|TranscodingsShape $transcodings
     * @param Uploads|UploadsShape $uploads
     */
    public static function with(
        Assets|array $assets,
        Captions|array $captions,
        CreditsSpent|array $creditsSpent,
        string $date,
        Egress|array $egress,
        Notifications|array $notifications,
        Sources|array $sources,
        StaticRenditions|array $staticRenditions,
        Thumbnails|array $thumbnails,
        Transcodings|array $transcodings,
        Uploads|array $uploads,
    ): self {
        $self = new self;

        $self['assets'] = $assets;
        $self['captions'] = $captions;
        $self['creditsSpent'] = $creditsSpent;
        $self['date'] = $date;
        $self['egress'] = $egress;
        $self['notifications'] = $notifications;
        $self['sources'] = $sources;
        $self['staticRenditions'] = $staticRenditions;
        $self['thumbnails'] = $thumbnails;
        $self['transcodings'] = $transcodings;
        $self['uploads'] = $uploads;

        return $self;
    }

    /**
     * Asset processing usage.
     *
     * @param Assets|AssetsShape $assets
     */
    public function withAssets(Assets|array $assets): self
    {
        $self = clone $this;
        $self['assets'] = $assets;

        return $self;
    }

    /**
     * Caption processing usage.
     *
     * @param Captions|CaptionsShape $captions
     */
    public function withCaptions(Captions|array $captions): self
    {
        $self = clone $this;
        $self['captions'] = $captions;

        return $self;
    }

    /**
     * Settled credits in integer units, with 10000 units equal to USD 1 of credits. Category values are parts of total, not additional charges.
     *
     * @param CreditsSpent|CreditsSpentShape $creditsSpent
     */
    public function withCreditsSpent(CreditsSpent|array $creditsSpent): self
    {
        $self = clone $this;
        $self['creditsSpent'] = $creditsSpent;

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

    /**
     * Recorded output egress eligible for the transfer tariff. Provider-exempt transfers are excluded.
     *
     * @param Egress|EgressShape $egress
     */
    public function withEgress(Egress|array $egress): self
    {
        $self = clone $this;
        $self['egress'] = $egress;

        return $self;
    }

    /**
     * Webhook delivery activity.
     *
     * @param Notifications|NotificationsShape $notifications
     */
    public function withNotifications(Notifications|array $notifications): self
    {
        $self = clone $this;
        $self['notifications'] = $notifications;

        return $self;
    }

    /**
     * Source ingestion activity.
     *
     * @param Sources|SourcesShape $sources
     */
    public function withSources(Sources|array $sources): self
    {
        $self = clone $this;
        $self['sources'] = $sources;

        return $self;
    }

    /**
     * Static rendition usage.
     *
     * @param StaticRenditions|StaticRenditionsShape $staticRenditions
     */
    public function withStaticRenditions(
        StaticRenditions|array $staticRenditions
    ): self {
        $self = clone $this;
        $self['staticRenditions'] = $staticRenditions;

        return $self;
    }

    /**
     * Thumbnail processing usage.
     *
     * @param Thumbnails|ThumbnailsShape $thumbnails
     */
    public function withThumbnails(Thumbnails|array $thumbnails): self
    {
        $self = clone $this;
        $self['thumbnails'] = $thumbnails;

        return $self;
    }

    /**
     * Standalone Transcoding usage.
     *
     * @param Transcodings|TranscodingsShape $transcodings
     */
    public function withTranscodings(Transcodings|array $transcodings): self
    {
        $self = clone $this;
        $self['transcodings'] = $transcodings;

        return $self;
    }

    /**
     * Upload activity.
     *
     * @param Uploads|UploadsShape $uploads
     */
    public function withUploads(Uploads|array $uploads): self
    {
        $self = clone $this;
        $self['uploads'] = $uploads;

        return $self;
    }
}
