<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Assets\Asset\CreatedVia;
use Chunkify\Assets\Asset\Error;
use Chunkify\Assets\Asset\MaxResolution;
use Chunkify\Assets\Asset\MinResolution;
use Chunkify\Assets\Asset\Poster;
use Chunkify\Assets\Asset\SourceMetadata;
use Chunkify\Assets\Asset\TimelinePreviews;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SourceMetadataShape from \Chunkify\Assets\Asset\SourceMetadata
 * @phpstan-import-type ErrorShape from \Chunkify\Assets\Asset\Error
 * @phpstan-import-type PosterShape from \Chunkify\Assets\Asset\Poster
 * @phpstan-import-type TimelinePreviewsShape from \Chunkify\Assets\Asset\TimelinePreviews
 *
 * @phpstan-type AssetShape = array{
 *   id: string,
 *   canAddStaticRenditions: bool,
 *   createdAt: \DateTimeInterface,
 *   maxResolution: MaxResolution|value-of<MaxResolution>,
 *   metadata: array<string,string>,
 *   minResolution: MinResolution|value-of<MinResolution>,
 *   playbackReady: bool,
 *   previewEnabled: bool,
 *   sourceMetadata: SourceMetadata|SourceMetadataShape,
 *   status: AssetStatus|value-of<AssetStatus>,
 *   storageID: string,
 *   title: string,
 *   updatedAt: \DateTimeInterface,
 *   workflowID: string|null,
 *   workflowRevision: int|null,
 *   cdnURL?: string|null,
 *   createdByTokenID?: string|null,
 *   createdByUserID?: string|null,
 *   createdVia?: null|CreatedVia|value-of<CreatedVia>,
 *   error?: null|Error|ErrorShape,
 *   expiresAt?: \DateTimeInterface|null,
 *   playbackPath?: string|null,
 *   playbackReadyAt?: \DateTimeInterface|null,
 *   poster?: null|Poster|PosterShape,
 *   previewURL?: string|null,
 *   readyAt?: \DateTimeInterface|null,
 *   size?: int|null,
 *   sourceID?: string|null,
 *   timelinePreviews?: null|TimelinePreviews|TimelinePreviewsShape,
 * }
 */
final class Asset implements BaseModel
{
    /** @use SdkModel<AssetShape> */
    use SdkModel;

    /**
     * Unique Asset ID.
     */
    #[Required]
    public string $id;

    /**
     * Whether the Asset can accept new static rendition requests. Creation can still fail if the original video is no longer accessible.
     */
    #[Required('can_add_static_renditions')]
    public bool $canAddStaticRenditions;

    /**
     * When the Asset was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Maximum streaming resolution selected at creation. Does not limit static renditions.
     *
     * @var value-of<MaxResolution> $maxResolution
     */
    #[Required('max_resolution', enum: MaxResolution::class)]
    public string $maxResolution;

    /**
     * String metadata attached to the Asset.
     *
     * @var array<string,string> $metadata
     */
    #[Required(map: 'string')]
    public array $metadata;

    /**
     * Minimum streaming resolution selected at creation. auto means no minimum; smaller sources are not upscaled.
     *
     * @var value-of<MinResolution> $minResolution
     */
    #[Required('min_resolution', enum: MinResolution::class)]
    public string $minResolution;

    /**
     * Whether HLS playback is available, including while the Asset is preparing.
     */
    #[Required('playback_ready')]
    public bool $playbackReady;

    /**
     * Allow public preview access without an API token. Does not control CDN or static download access. Disabling it does not revoke signed URLs already issued.
     */
    #[Required('preview_enabled')]
    public bool $previewEnabled;

    /**
     * Original media metadata saved at Asset creation and preserved after Source deletion.
     */
    #[Required('source_metadata')]
    public SourceMetadata $sourceMetadata;

    /**
     * Status specifies the Asset preparation state. ready means the video is prepared for playback, with its poster and timeline previews available. Static renditions and captions have independent statuses.
     *
     * @var value-of<AssetStatus> $status
     */
    #[Required(enum: AssetStatus::class)]
    public string $status;

    /**
     * ID of the output Storage.
     */
    #[Required('storage_id')]
    public string $storageID;

    /**
     * Asset title.
     */
    #[Required]
    public string $title;

    /**
     * When the Asset was last updated.
     */
    #[Required('updated_at')]
    public \DateTimeInterface $updatedAt;

    /**
     * Selected Workflow ID, or null.
     */
    #[Required('workflow_id')]
    public ?string $workflowID;

    /**
     * Pinned Workflow revision, or null.
     */
    #[Required('workflow_revision')]
    public ?int $workflowRevision;

    /**
     * Unsigned CDN URL of the HLS master playlist. Available when playback_ready is true and Storage has a CDN URL.
     */
    #[Optional('cdn_url')]
    public ?string $cdnURL;

    /**
     * CreatedByTokenId specifies the Project token used to create the resource. It remains set after the token is revoked.
     * Omitted for dashboard requests, MCP OAuth connections, Workflow actions, and unknown creators.
     */
    #[Optional('created_by_token_id')]
    public ?string $createdByTokenID;

    /**
     * CreatedByUserId specifies the team member who created the resource.
     * Omitted for Workflow actions, unknown creators, and deleted accounts.
     */
    #[Optional('created_by_user_id')]
    public ?string $createdByUserID;

    /**
     * CreatedVia specifies how the resource was created: api for API requests, dashboard for the Chunkify dashboard, mcp for MCP clients, and workflow for Workflow actions.
     * Omitted when the creator is unknown.
     *
     * @var value-of<CreatedVia>|null $createdVia
     */
    #[Optional('created_via', enum: CreatedVia::class)]
    public ?string $createdVia;

    #[Optional]
    public ?Error $error;

    /**
     * When managed outputs expire, 24 hours after readiness. Omitted for customer-connected Storage.
     */
    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /**
     * Path of the HLS master playlist in Storage. Available when playback_ready is true.
     */
    #[Optional('playback_path')]
    public ?string $playbackPath;

    /**
     * When HLS playback first became available.
     */
    #[Optional('playback_ready_at')]
    public ?\DateTimeInterface $playbackReadyAt;

    /**
     * Poster image, available once generated.
     */
    #[Optional]
    public ?Poster $poster;

    /**
     * Public HLS preview URL. Available when playback_ready and preview_enabled are true. No API token is required.
     */
    #[Optional('preview_url')]
    public ?string $previewURL;

    /**
     * When all required Asset outputs finished processing.
     */
    #[Optional('ready_at')]
    public ?\DateTimeInterface $readyAt;

    /**
     * Size specifies the total bytes of available streaming, playback preview, poster, and timeline files. Excludes static renditions. Omitted until the Asset is ready.
     */
    #[Optional]
    public ?int $size;

    /**
     * Original Source ID. Omitted after Source deletion.
     */
    #[Optional('source_id')]
    public ?string $sourceID;

    /**
     * Timeline thumbnails. The WebVTT file maps video timestamps to image URLs and crop coordinates.
     */
    #[Optional('timeline_previews')]
    public ?TimelinePreviews $timelinePreviews;

    /**
     * `new Asset()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Asset::with(
     *   id: ...,
     *   canAddStaticRenditions: ...,
     *   createdAt: ...,
     *   maxResolution: ...,
     *   metadata: ...,
     *   minResolution: ...,
     *   playbackReady: ...,
     *   previewEnabled: ...,
     *   sourceMetadata: ...,
     *   status: ...,
     *   storageID: ...,
     *   title: ...,
     *   updatedAt: ...,
     *   workflowID: ...,
     *   workflowRevision: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Asset)
     *   ->withID(...)
     *   ->withCanAddStaticRenditions(...)
     *   ->withCreatedAt(...)
     *   ->withMaxResolution(...)
     *   ->withMetadata(...)
     *   ->withMinResolution(...)
     *   ->withPlaybackReady(...)
     *   ->withPreviewEnabled(...)
     *   ->withSourceMetadata(...)
     *   ->withStatus(...)
     *   ->withStorageID(...)
     *   ->withTitle(...)
     *   ->withUpdatedAt(...)
     *   ->withWorkflowID(...)
     *   ->withWorkflowRevision(...)
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
     * @param MaxResolution|value-of<MaxResolution> $maxResolution
     * @param array<string,string> $metadata
     * @param MinResolution|value-of<MinResolution> $minResolution
     * @param SourceMetadata|SourceMetadataShape $sourceMetadata
     * @param AssetStatus|value-of<AssetStatus> $status
     * @param CreatedVia|value-of<CreatedVia>|null $createdVia
     * @param Error|ErrorShape|null $error
     * @param Poster|PosterShape|null $poster
     * @param TimelinePreviews|TimelinePreviewsShape|null $timelinePreviews
     */
    public static function with(
        string $id,
        bool $canAddStaticRenditions,
        \DateTimeInterface $createdAt,
        MaxResolution|string $maxResolution,
        array $metadata,
        MinResolution|string $minResolution,
        bool $playbackReady,
        bool $previewEnabled,
        SourceMetadata|array $sourceMetadata,
        AssetStatus|string $status,
        string $storageID,
        string $title,
        \DateTimeInterface $updatedAt,
        ?string $workflowID,
        ?int $workflowRevision,
        ?string $cdnURL = null,
        ?string $createdByTokenID = null,
        ?string $createdByUserID = null,
        CreatedVia|string|null $createdVia = null,
        Error|array|null $error = null,
        ?\DateTimeInterface $expiresAt = null,
        ?string $playbackPath = null,
        ?\DateTimeInterface $playbackReadyAt = null,
        Poster|array|null $poster = null,
        ?string $previewURL = null,
        ?\DateTimeInterface $readyAt = null,
        ?int $size = null,
        ?string $sourceID = null,
        TimelinePreviews|array|null $timelinePreviews = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['canAddStaticRenditions'] = $canAddStaticRenditions;
        $self['createdAt'] = $createdAt;
        $self['maxResolution'] = $maxResolution;
        $self['metadata'] = $metadata;
        $self['minResolution'] = $minResolution;
        $self['playbackReady'] = $playbackReady;
        $self['previewEnabled'] = $previewEnabled;
        $self['sourceMetadata'] = $sourceMetadata;
        $self['status'] = $status;
        $self['storageID'] = $storageID;
        $self['title'] = $title;
        $self['updatedAt'] = $updatedAt;
        $self['workflowID'] = $workflowID;
        $self['workflowRevision'] = $workflowRevision;

        null !== $cdnURL && $self['cdnURL'] = $cdnURL;
        null !== $createdByTokenID && $self['createdByTokenID'] = $createdByTokenID;
        null !== $createdByUserID && $self['createdByUserID'] = $createdByUserID;
        null !== $createdVia && $self['createdVia'] = $createdVia;
        null !== $error && $self['error'] = $error;
        null !== $expiresAt && $self['expiresAt'] = $expiresAt;
        null !== $playbackPath && $self['playbackPath'] = $playbackPath;
        null !== $playbackReadyAt && $self['playbackReadyAt'] = $playbackReadyAt;
        null !== $poster && $self['poster'] = $poster;
        null !== $previewURL && $self['previewURL'] = $previewURL;
        null !== $readyAt && $self['readyAt'] = $readyAt;
        null !== $size && $self['size'] = $size;
        null !== $sourceID && $self['sourceID'] = $sourceID;
        null !== $timelinePreviews && $self['timelinePreviews'] = $timelinePreviews;

        return $self;
    }

    /**
     * Unique Asset ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Whether the Asset can accept new static rendition requests. Creation can still fail if the original video is no longer accessible.
     */
    public function withCanAddStaticRenditions(
        bool $canAddStaticRenditions
    ): self {
        $self = clone $this;
        $self['canAddStaticRenditions'] = $canAddStaticRenditions;

        return $self;
    }

    /**
     * When the Asset was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Maximum streaming resolution selected at creation. Does not limit static renditions.
     *
     * @param MaxResolution|value-of<MaxResolution> $maxResolution
     */
    public function withMaxResolution(MaxResolution|string $maxResolution): self
    {
        $self = clone $this;
        $self['maxResolution'] = $maxResolution;

        return $self;
    }

    /**
     * String metadata attached to the Asset.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Minimum streaming resolution selected at creation. auto means no minimum; smaller sources are not upscaled.
     *
     * @param MinResolution|value-of<MinResolution> $minResolution
     */
    public function withMinResolution(MinResolution|string $minResolution): self
    {
        $self = clone $this;
        $self['minResolution'] = $minResolution;

        return $self;
    }

    /**
     * Whether HLS playback is available, including while the Asset is preparing.
     */
    public function withPlaybackReady(bool $playbackReady): self
    {
        $self = clone $this;
        $self['playbackReady'] = $playbackReady;

        return $self;
    }

    /**
     * Allow public preview access without an API token. Does not control CDN or static download access. Disabling it does not revoke signed URLs already issued.
     */
    public function withPreviewEnabled(bool $previewEnabled): self
    {
        $self = clone $this;
        $self['previewEnabled'] = $previewEnabled;

        return $self;
    }

    /**
     * Original media metadata saved at Asset creation and preserved after Source deletion.
     *
     * @param SourceMetadata|SourceMetadataShape $sourceMetadata
     */
    public function withSourceMetadata(
        SourceMetadata|array $sourceMetadata
    ): self {
        $self = clone $this;
        $self['sourceMetadata'] = $sourceMetadata;

        return $self;
    }

    /**
     * Status specifies the Asset preparation state. ready means the video is prepared for playback, with its poster and timeline previews available. Static renditions and captions have independent statuses.
     *
     * @param AssetStatus|value-of<AssetStatus> $status
     */
    public function withStatus(AssetStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * ID of the output Storage.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Asset title.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * When the Asset was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * Selected Workflow ID, or null.
     */
    public function withWorkflowID(?string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * Pinned Workflow revision, or null.
     */
    public function withWorkflowRevision(?int $workflowRevision): self
    {
        $self = clone $this;
        $self['workflowRevision'] = $workflowRevision;

        return $self;
    }

    /**
     * Unsigned CDN URL of the HLS master playlist. Available when playback_ready is true and Storage has a CDN URL.
     */
    public function withCdnURL(string $cdnURL): self
    {
        $self = clone $this;
        $self['cdnURL'] = $cdnURL;

        return $self;
    }

    /**
     * CreatedByTokenId specifies the Project token used to create the resource. It remains set after the token is revoked.
     * Omitted for dashboard requests, MCP OAuth connections, Workflow actions, and unknown creators.
     */
    public function withCreatedByTokenID(string $createdByTokenID): self
    {
        $self = clone $this;
        $self['createdByTokenID'] = $createdByTokenID;

        return $self;
    }

    /**
     * CreatedByUserId specifies the team member who created the resource.
     * Omitted for Workflow actions, unknown creators, and deleted accounts.
     */
    public function withCreatedByUserID(string $createdByUserID): self
    {
        $self = clone $this;
        $self['createdByUserID'] = $createdByUserID;

        return $self;
    }

    /**
     * CreatedVia specifies how the resource was created: api for API requests, dashboard for the Chunkify dashboard, mcp for MCP clients, and workflow for Workflow actions.
     * Omitted when the creator is unknown.
     *
     * @param CreatedVia|value-of<CreatedVia> $createdVia
     */
    public function withCreatedVia(CreatedVia|string $createdVia): self
    {
        $self = clone $this;
        $self['createdVia'] = $createdVia;

        return $self;
    }

    /**
     * @param Error|ErrorShape $error
     */
    public function withError(Error|array $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * When managed outputs expire, 24 hours after readiness. Omitted for customer-connected Storage.
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Path of the HLS master playlist in Storage. Available when playback_ready is true.
     */
    public function withPlaybackPath(string $playbackPath): self
    {
        $self = clone $this;
        $self['playbackPath'] = $playbackPath;

        return $self;
    }

    /**
     * When HLS playback first became available.
     */
    public function withPlaybackReadyAt(
        \DateTimeInterface $playbackReadyAt
    ): self {
        $self = clone $this;
        $self['playbackReadyAt'] = $playbackReadyAt;

        return $self;
    }

    /**
     * Poster image, available once generated.
     *
     * @param Poster|PosterShape $poster
     */
    public function withPoster(Poster|array $poster): self
    {
        $self = clone $this;
        $self['poster'] = $poster;

        return $self;
    }

    /**
     * Public HLS preview URL. Available when playback_ready and preview_enabled are true. No API token is required.
     */
    public function withPreviewURL(string $previewURL): self
    {
        $self = clone $this;
        $self['previewURL'] = $previewURL;

        return $self;
    }

    /**
     * When all required Asset outputs finished processing.
     */
    public function withReadyAt(\DateTimeInterface $readyAt): self
    {
        $self = clone $this;
        $self['readyAt'] = $readyAt;

        return $self;
    }

    /**
     * Size specifies the total bytes of available streaming, playback preview, poster, and timeline files. Excludes static renditions. Omitted until the Asset is ready.
     */
    public function withSize(int $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Original Source ID. Omitted after Source deletion.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Timeline thumbnails. The WebVTT file maps video timestamps to image URLs and crop coordinates.
     *
     * @param TimelinePreviews|TimelinePreviewsShape $timelinePreviews
     */
    public function withTimelinePreviews(
        TimelinePreviews|array $timelinePreviews
    ): self {
        $self = clone $this;
        $self['timelinePreviews'] = $timelinePreviews;

        return $self;
    }
}
