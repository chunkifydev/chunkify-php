<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Omit;
use Chunkify\Projects\ProjectUpdateParams\AssetDefaults;

/**
 * Update a project's name or storage settings. Only team owners can update projects.
 *
 * @see Chunkify\Services\ProjectsService::update()
 *
 * @phpstan-import-type AssetDefaultsShape from \Chunkify\Projects\ProjectUpdateParams\AssetDefaults
 *
 * @phpstan-type ProjectUpdateParamsShape = array{
 *   assetDefaults?: null|AssetDefaults|AssetDefaultsShape,
 *   defaultWorkflowID?: string|null,
 *   name?: string|null,
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
    public ?AssetDefaults $assetDefaults;

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
     * @param AssetDefaults|AssetDefaultsShape|null $assetDefaults
     */
    public static function with(
        AssetDefaults|array|null $assetDefaults = null,
        string|Omit|null $defaultWorkflowID = Omit::Value,
        ?string $name = null,
        ?string $storageID = null,
    ): self {
        $self = new self;

        null !== $assetDefaults && $self['assetDefaults'] = $assetDefaults;
        Omit::Value !== $defaultWorkflowID && $self['defaultWorkflowID'] = $defaultWorkflowID;
        null !== $name && $self['name'] = $name;
        null !== $storageID && $self['storageID'] = $storageID;

        return $self;
    }

    /**
     * Defaults for new Assets and automatic Uploads. Replaces the whole object. Omitted fields reset to their defaults. Existing Assets are unchanged.
     *
     * @param AssetDefaults|AssetDefaultsShape $assetDefaults
     */
    public function withAssetDefaults(AssetDefaults|array $assetDefaults): self
    {
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
     * ID of this Project's default Storage.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

        return $self;
    }
}
