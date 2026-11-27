<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Assets\AssetDefaultsParams;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Omit;

/**
 * Update a Project's name, default Storage, Asset defaults, or default Workflow. Only team owners can update Projects, and project names must be unique.
 *
 * @see Chunkify\Services\ProjectsService::update()
 *
 * @phpstan-import-type AssetDefaultsParamsShape from \Chunkify\Assets\AssetDefaultsParams
 * @phpstan-import-type PlayerAppearanceParamsShape from \Chunkify\Projects\PlayerAppearanceParams
 *
 * @phpstan-type ProjectUpdateParamsShape = array{
 *   assetDefaults?: null|AssetDefaultsParams|AssetDefaultsParamsShape,
 *   defaultWorkflowID?: string|null,
 *   name?: string|null,
 *   playerAppearance?: null|PlayerAppearanceParams|PlayerAppearanceParamsShape,
 *   storageID?: string|null,
 * }
 */
final class ProjectUpdateParams implements BaseModel
{
    /** @use SdkModel<ProjectUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Defaults for new Assets and automatic Uploads. Replaces the whole object. Omitted fields reset to their defaults. Existing Assets are unchanged.
     */
    #[Optional('asset_defaults')]
    public ?AssetDefaultsParams $assetDefaults;

    /**
     * DefaultWorkflowId specifies the default Workflow for new Assets. Set null to clear it.
     */
    #[Optional('default_workflow_id', nullable: true)]
    public ?string $defaultWorkflowID;

    /**
     * Project name.
     */
    #[Optional]
    public ?string $name;

    /**
     * Player colours and controls for Chunkify-hosted playback pages, such as embeds. Replaces the whole object. Omitted fields reset to their defaults. Existing embeds use the new values.
     */
    #[Optional('player_appearance')]
    public ?PlayerAppearanceParams $playerAppearance;

    /**
     * ID of this Project's default Storage.
     */
    #[Optional('storage_id')]
    public ?string $storageID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AssetDefaultsParams|AssetDefaultsParamsShape|null $assetDefaults
     * @param PlayerAppearanceParams|PlayerAppearanceParamsShape|null $playerAppearance
     */
    public static function with(
        AssetDefaultsParams|array|null $assetDefaults = null,
        string|Omit|null $defaultWorkflowID = Omit::Value,
        ?string $name = null,
        PlayerAppearanceParams|array|null $playerAppearance = null,
        ?string $storageID = null,
    ): self {
        $self = new self;

        null !== $assetDefaults && $self['assetDefaults'] = $assetDefaults;
        Omit::Value !== $defaultWorkflowID && $self['defaultWorkflowID'] = $defaultWorkflowID;
        null !== $name && $self['name'] = $name;
        null !== $playerAppearance && $self['playerAppearance'] = $playerAppearance;
        null !== $storageID && $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Defaults for new Assets and automatic Uploads. Replaces the whole object. Omitted fields reset to their defaults. Existing Assets are unchanged.
     *
     * @param AssetDefaultsParams|AssetDefaultsParamsShape $assetDefaults
     */
    public function withAssetDefaults(
        AssetDefaultsParams|array $assetDefaults
    ): self {
        $self = clone $this;
        $self['assetDefaults'] = $assetDefaults;

        return $self;
    }

    /**
     * DefaultWorkflowId specifies the default Workflow for new Assets. Set null to clear it.
     */
    public function withDefaultWorkflowID(?string $defaultWorkflowID): self
    {
        $self = clone $this;
        $self['defaultWorkflowID'] = $defaultWorkflowID;

        return $self;
    }

    /**
     * Project name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Player colours and controls for Chunkify-hosted playback pages, such as embeds. Replaces the whole object. Omitted fields reset to their defaults. Existing embeds use the new values.
     *
     * @param PlayerAppearanceParams|PlayerAppearanceParamsShape $playerAppearance
     */
    public function withPlayerAppearance(
        PlayerAppearanceParams|array $playerAppearance
    ): self {
        $self = clone $this;
        $self['playerAppearance'] = $playerAppearance;

        return $self;
    }

    /**
     * ID of this Project's default Storage.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }
}
