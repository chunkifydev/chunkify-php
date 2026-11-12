<?php

declare(strict_types=1);

namespace Chunkify\Metrics\MetricsUsage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Metrics\MetricsUsage\Summary\Assets;
use Chunkify\Metrics\MetricsUsage\Summary\Captions;
use Chunkify\Metrics\MetricsUsage\Summary\CreditsSpent;
use Chunkify\Metrics\MetricsUsage\Summary\Egress;
use Chunkify\Metrics\MetricsUsage\Summary\Notifications;
use Chunkify\Metrics\MetricsUsage\Summary\Sources;
use Chunkify\Metrics\MetricsUsage\Summary\StaticRenditions;
use Chunkify\Metrics\MetricsUsage\Summary\Thumbnails;
use Chunkify\Metrics\MetricsUsage\Summary\Transcodings;
use Chunkify\Metrics\MetricsUsage\Summary\Uploads;

/**
 * Summary specifies totals across the selected period.
 *
 * @phpstan-import-type AssetsShape from \Chunkify\Metrics\MetricsUsage\Summary\Assets
 * @phpstan-import-type CaptionsShape from \Chunkify\Metrics\MetricsUsage\Summary\Captions
 * @phpstan-import-type CreditsSpentShape from \Chunkify\Metrics\MetricsUsage\Summary\CreditsSpent
 * @phpstan-import-type EgressShape from \Chunkify\Metrics\MetricsUsage\Summary\Egress
 * @phpstan-import-type NotificationsShape from \Chunkify\Metrics\MetricsUsage\Summary\Notifications
 * @phpstan-import-type SourcesShape from \Chunkify\Metrics\MetricsUsage\Summary\Sources
 * @phpstan-import-type StaticRenditionsShape from \Chunkify\Metrics\MetricsUsage\Summary\StaticRenditions
 * @phpstan-import-type ThumbnailsShape from \Chunkify\Metrics\MetricsUsage\Summary\Thumbnails
 * @phpstan-import-type TranscodingsShape from \Chunkify\Metrics\MetricsUsage\Summary\Transcodings
 * @phpstan-import-type UploadsShape from \Chunkify\Metrics\MetricsUsage\Summary\Uploads
 *
 * @phpstan-type SummaryShape = array{
 *   assets: Assets|AssetsShape,
 *   captions: Captions|CaptionsShape,
 *   creditsSpent: CreditsSpent|CreditsSpentShape,
 *   egress: Egress|EgressShape,
 *   notifications: Notifications|NotificationsShape,
 *   sources: Sources|SourcesShape,
 *   staticRenditions: StaticRenditions|StaticRenditionsShape,
 *   thumbnails: Thumbnails|ThumbnailsShape,
 *   transcodings: Transcodings|TranscodingsShape,
 *   uploads: Uploads|UploadsShape,
 * }
 */
final class Summary implements BaseModel
{
    /** @use SdkModel<SummaryShape> */
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
     * `new Summary()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Summary::with(
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
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Summary)
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
