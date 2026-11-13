<?php

declare(strict_types=1);

namespace Chunkify\Projects;

use Chunkify\Assets\AssetDefaults;
use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Core\Omit;

/**
 * @phpstan-import-type AssetDefaultsShape from \Chunkify\Assets\AssetDefaults
 *
 * @phpstan-type ProjectShape = array{
 *   id: string,
 *   assetDefaults: AssetDefaults|AssetDefaultsShape,
 *   createdAt: \DateTimeInterface,
 *   name: string,
 *   slug: string,
 *   storageID: string,
 *   defaultWorkflowID?: string|null,
 * }
 */
final class Project implements BaseModel
{
    /** @use SdkModel<ProjectShape> */
    use SdkModel;

    /**
     * Id is the unique identifier for the project.
     */
    #[Required]
    public string $id;

    /**
     * Defaults for new Assets, including Assets created from Uploads.
     */
    #[Required('asset_defaults')]
    public AssetDefaults $assetDefaults;

    /**
     * Timestamp when the project was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Name of the project.
     */
    #[Required]
    public string $name;

    /**
     * Slug is the slug for the project.
     */
    #[Required]
    public string $slug;

    /**
     * StorageId identifier where project files are stored.
     */
    #[Required('storage_id')]
    public string $storageID;

    /**
     * DefaultWorkflowId specifies the default Workflow for new Assets. Set null to clear it.
     */
    #[Optional('default_workflow_id', nullable: true)]
    public ?string $defaultWorkflowID;

    /**
     * `new Project()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Project::with(
     *   id: ...,
     *   assetDefaults: ...,
     *   createdAt: ...,
     *   name: ...,
     *   slug: ...,
     *   storageID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Project)
     *   ->withID(...)
     *   ->withAssetDefaults(...)
     *   ->withCreatedAt(...)
     *   ->withName(...)
     *   ->withSlug(...)
     *   ->withStorageID(...)
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
     * @param AssetDefaults|AssetDefaultsShape $assetDefaults
     */
    public static function with(
        string $id,
        AssetDefaults|array $assetDefaults,
        \DateTimeInterface $createdAt,
        string $name,
        string $slug,
        string $storageID,
        string|Omit|null $defaultWorkflowID = Omit::Value,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['assetDefaults'] = $assetDefaults;
        $self['createdAt'] = $createdAt;
        $self['name'] = $name;
        $self['slug'] = $slug;
        $self['storageID'] = $storageID;

        Omit::Value !== $defaultWorkflowID && $self['defaultWorkflowID'] = $defaultWorkflowID;

        return $self;
    }

    /**
     * Id is the unique identifier for the project.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Defaults for new Assets, including Assets created from Uploads.
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
     * Timestamp when the project was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Name of the project.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Slug is the slug for the project.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * StorageId identifier where project files are stored.
     */
    public function withStorageID(string $storageID): self
    {
        $self = clone $this;
        $self['storageID'] = $storageID;

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
}
