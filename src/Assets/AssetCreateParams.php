<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Assets\AssetCreateParams\MaxResolution;
use Chunkify\Assets\AssetCreateParams\MinResolution;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Omit;

/**
 * Create an Asset from a video Source. Processing starts asynchronously.
 *
 * @see Chunkify\Services\AssetsService::create()
 *
 * @phpstan-import-type AssetCreateStorageParamsShape from \Chunkify\Assets\AssetCreateStorageParams
 *
 * @phpstan-type AssetCreateParamsShape = array{
 *   sourceID: string,
 *   maxResolution?: null|MaxResolution|value-of<MaxResolution>,
 *   metadata?: array<string,string>|null,
 *   minResolution?: null|MinResolution|value-of<MinResolution>,
 *   pathTemplate?: string|null,
 *   previewEnabled?: bool|null,
 *   storage?: null|AssetCreateStorageParams|AssetCreateStorageParamsShape,
 *   title?: string|null,
 *   workflowID?: string|null,
 * }
 */
final class AssetCreateParams implements BaseModel
{
    /** @use SdkModel<AssetCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * ID of the video Source to process.
     */
    #[Required('source_id')]
    public string $sourceID;

    /**
     * Maximum streaming resolution. Omit to use the Project default, or the plan maximum if unset. 2160p requires Starter or above. Smaller sources are not upscaled. Does not affect static renditions.
     *
     * @var value-of<MaxResolution>|null $maxResolution
     */
    #[Optional('max_resolution', enum: MaxResolution::class)]
    public ?string $maxResolution;

    /**
     * String metadata with a maximum encoded JSON size of 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Minimum streaming resolution. Omit to use the Project default; auto removes the minimum. Must not exceed max_resolution. Smaller sources are not upscaled. Does not affect static renditions.
     *
     * @var value-of<MinResolution>|null $minResolution
     */
    #[Optional('min_resolution', enum: MinResolution::class)]
    public ?string $minResolution;

    /**
     * PathTemplate specifies the Asset output folder relative to Storage base_prefix.
     * Supports {assetID} and case-sensitive {metadata.<key>}; referenced values must be non-empty.
     * Ignored for Chunkify storage, which always uses {assetID}.
     * Overrides the Project default. Defaults to {assetID} when neither is set. Maximum template size: 1024 UTF-8 bytes. Expanded prefix: 768 bytes including base_prefix and trailing slash.
     */
    #[Optional('path_template')]
    public ?string $pathTemplate;

    /**
     * Allow public preview access without an API token. Omit to use the Project default. Does not control CDN or static download access.
     */
    #[Optional('preview_enabled')]
    public ?bool $previewEnabled;

    /**
     * Output Storage. Omit to use the Project default. The path_template controls the folder for generated output paths.
     */
    #[Optional]
    public ?AssetCreateStorageParams $storage;

    /**
     * Asset title, up to 256 characters. Defaults to an empty string.
     */
    #[Optional]
    public ?string $title;

    /**
     * WorkflowId specifies the Workflow to select. Omit to use the Project default. Set null to disable automatic actions. The current revision is pinned when creation is accepted.
     */
    #[Optional('workflow_id', nullable: true)]
    public ?string $workflowID;

    /**
     * `new AssetCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetCreateParams::with(sourceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetCreateParams)->withSourceID(...)
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
     * @param MaxResolution|value-of<MaxResolution>|null $maxResolution
     * @param array<string,string>|null $metadata
     * @param MinResolution|value-of<MinResolution>|null $minResolution
     * @param AssetCreateStorageParams|AssetCreateStorageParamsShape|null $storage
     */
    public static function with(
        string $sourceID,
        MaxResolution|string|null $maxResolution = null,
        ?array $metadata = null,
        MinResolution|string|null $minResolution = null,
        ?string $pathTemplate = null,
        ?bool $previewEnabled = null,
        AssetCreateStorageParams|array|null $storage = null,
        ?string $title = null,
        string|Omit|null $workflowID = Omit::Value,
    ): self {
        $self = new self;

        $self['sourceID'] = $sourceID;

        null !== $maxResolution && $self['maxResolution'] = $maxResolution;
        null !== $metadata && $self['metadata'] = $metadata;
        null !== $minResolution && $self['minResolution'] = $minResolution;
        null !== $pathTemplate && $self['pathTemplate'] = $pathTemplate;
        null !== $previewEnabled && $self['previewEnabled'] = $previewEnabled;
        null !== $storage && $self['storage'] = $storage;
        null !== $title && $self['title'] = $title;
        Omit::Value !== $workflowID && $self['workflowID'] = $workflowID;

        return $self;
    }

    /**
     * ID of the video Source to process.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Maximum streaming resolution. Omit to use the Project default, or the plan maximum if unset. 2160p requires Starter or above. Smaller sources are not upscaled. Does not affect static renditions.
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
     * String metadata with a maximum encoded JSON size of 2048 bytes.
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
     * Minimum streaming resolution. Omit to use the Project default; auto removes the minimum. Must not exceed max_resolution. Smaller sources are not upscaled. Does not affect static renditions.
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
     * PathTemplate specifies the Asset output folder relative to Storage base_prefix.
     * Supports {assetID} and case-sensitive {metadata.<key>}; referenced values must be non-empty.
     * Ignored for Chunkify storage, which always uses {assetID}.
     * Overrides the Project default. Defaults to {assetID} when neither is set. Maximum template size: 1024 UTF-8 bytes. Expanded prefix: 768 bytes including base_prefix and trailing slash.
     */
    public function withPathTemplate(string $pathTemplate): self
    {
        $self = clone $this;
        $self['pathTemplate'] = $pathTemplate;

        return $self;
    }

    /**
     * Allow public preview access without an API token. Omit to use the Project default. Does not control CDN or static download access.
     */
    public function withPreviewEnabled(bool $previewEnabled): self
    {
        $self = clone $this;
        $self['previewEnabled'] = $previewEnabled;

        return $self;
    }

    /**
     * Output Storage. Omit to use the Project default. The path_template controls the folder for generated output paths.
     *
     * @param AssetCreateStorageParams|AssetCreateStorageParamsShape $storage
     */
    public function withStorage(AssetCreateStorageParams|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    /**
     * Asset title, up to 256 characters. Defaults to an empty string.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * WorkflowId specifies the Workflow to select. Omit to use the Project default. Set null to disable automatic actions. The current revision is pinned when creation is accepted.
     */
    public function withWorkflowID(?string $workflowID): self
    {
        $self = clone $this;
        $self['workflowID'] = $workflowID;

        return $self;
    }
}
