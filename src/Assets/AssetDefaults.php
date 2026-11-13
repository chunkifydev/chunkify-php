<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetDefaultsShape = array{
 *   deleteFilesOnFailure?: bool|null,
 *   maxResolution?: null|AssetDefaultsMaxResolution|value-of<AssetDefaultsMaxResolution>,
 *   minResolution?: null|AssetDefaultsMinResolution|value-of<AssetDefaultsMinResolution>,
 *   pathTemplate?: string|null,
 *   previewEnabled?: bool|null,
 * }
 */
final class AssetDefaults implements BaseModel
{
    /** @use SdkModel<AssetDefaultsShape> */
    use SdkModel;

    /**
     * Delete generated and partial files from the output Storage when a new Asset fails. The Asset record and original Source are preserved. Cleanup is attempted once after a delay and requires delete permission on the Storage. Defaults to false. Existing Assets are unchanged.
     */
    #[Optional('delete_files_on_failure')]
    public ?bool $deleteFilesOnFailure;

    /**
     * Maximum streaming resolution. Defaults to 1080p on Hobby and 2160p on other plans. 2160p requires Starter or above. Smaller sources are not upscaled. Does not affect static renditions.
     *
     * @var value-of<AssetDefaultsMaxResolution>|null $maxResolution
     */
    #[Optional('max_resolution', enum: AssetDefaultsMaxResolution::class)]
    public ?string $maxResolution;

    /**
     * Minimum streaming resolution. Defaults to auto, with no minimum. Must not exceed max_resolution. Smaller sources are not upscaled. Does not affect static renditions.
     *
     * @var value-of<AssetDefaultsMinResolution>|null $minResolution
     */
    #[Optional('min_resolution', enum: AssetDefaultsMinResolution::class)]
    public ?string $minResolution;

    /**
     * PathTemplate specifies the Asset output folder relative to Storage base_prefix.
     * Supports {assetID} and case-sensitive {metadata.<key>}; referenced values must be non-empty.
     * Ignored for Chunkify storage, which always uses {assetID}.
     * Defaults to {assetID}. Maximum template size: 1024 UTF-8 bytes. Expanded prefix: 768 bytes including base_prefix and trailing slash.
     */
    #[Optional('path_template')]
    public ?string $pathTemplate;

    /**
     * Allow public preview access for new Assets without an API token. Defaults to true. Existing Assets are unchanged.
     */
    #[Optional('preview_enabled')]
    public ?bool $previewEnabled;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AssetDefaultsMaxResolution|value-of<AssetDefaultsMaxResolution>|null $maxResolution
     * @param AssetDefaultsMinResolution|value-of<AssetDefaultsMinResolution>|null $minResolution
     */
    public static function with(
        ?bool $deleteFilesOnFailure = null,
        AssetDefaultsMaxResolution|string|null $maxResolution = null,
        AssetDefaultsMinResolution|string|null $minResolution = null,
        ?string $pathTemplate = null,
        ?bool $previewEnabled = null,
    ): self {
        $self = new self;

        null !== $deleteFilesOnFailure && $self['deleteFilesOnFailure'] = $deleteFilesOnFailure;
        null !== $maxResolution && $self['maxResolution'] = $maxResolution;
        null !== $minResolution && $self['minResolution'] = $minResolution;
        null !== $pathTemplate && $self['pathTemplate'] = $pathTemplate;
        null !== $previewEnabled && $self['previewEnabled'] = $previewEnabled;

        return $self;
    }

    /**
     * Delete generated and partial files from the output Storage when a new Asset fails. The Asset record and original Source are preserved. Cleanup is attempted once after a delay and requires delete permission on the Storage. Defaults to false. Existing Assets are unchanged.
     */
    public function withDeleteFilesOnFailure(bool $deleteFilesOnFailure): self
    {
        $self = clone $this;
        $self['deleteFilesOnFailure'] = $deleteFilesOnFailure;

        return $self;
    }

    /**
     * Maximum streaming resolution. Defaults to 1080p on Hobby and 2160p on other plans. 2160p requires Starter or above. Smaller sources are not upscaled. Does not affect static renditions.
     *
     * @param AssetDefaultsMaxResolution|value-of<AssetDefaultsMaxResolution> $maxResolution
     */
    public function withMaxResolution(
        AssetDefaultsMaxResolution|string $maxResolution
    ): self {
        $self = clone $this;
        $self['maxResolution'] = $maxResolution;

        return $self;
    }

    /**
     * Minimum streaming resolution. Defaults to auto, with no minimum. Must not exceed max_resolution. Smaller sources are not upscaled. Does not affect static renditions.
     *
     * @param AssetDefaultsMinResolution|value-of<AssetDefaultsMinResolution> $minResolution
     */
    public function withMinResolution(
        AssetDefaultsMinResolution|string $minResolution
    ): self {
        $self = clone $this;
        $self['minResolution'] = $minResolution;

        return $self;
    }

    /**
     * PathTemplate specifies the Asset output folder relative to Storage base_prefix.
     * Supports {assetID} and case-sensitive {metadata.<key>}; referenced values must be non-empty.
     * Ignored for Chunkify storage, which always uses {assetID}.
     * Defaults to {assetID}. Maximum template size: 1024 UTF-8 bytes. Expanded prefix: 768 bytes including base_prefix and trailing slash.
     */
    public function withPathTemplate(string $pathTemplate): self
    {
        $self = clone $this;
        $self['pathTemplate'] = $pathTemplate;

        return $self;
    }

    /**
     * Allow public preview access for new Assets without an API token. Defaults to true. Existing Assets are unchanged.
     */
    public function withPreviewEnabled(bool $previewEnabled): self
    {
        $self = clone $this;
        $self['previewEnabled'] = $previewEnabled;

        return $self;
    }
}
