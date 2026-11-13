<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * An Asset-owned static rendition output and its canonical resource details.
 *
 * @phpstan-import-type AssetStaticRenditionShape from \Chunkify\Assets\AssetStaticRendition
 *
 * @phpstan-type AssetStaticRenditionOutputShape = array{
 *   id: string,
 *   assetID: string,
 *   details: AssetStaticRendition|AssetStaticRenditionShape,
 *   status: AssetOutputStatus|value-of<AssetOutputStatus>,
 *   type: 'static_rendition',
 * }
 */
final class AssetStaticRenditionOutput implements BaseModel
{
    /** @use SdkModel<AssetStaticRenditionOutputShape> */
    use SdkModel;

    /**
     * Type identifies the output kind.
     *
     * @var 'static_rendition' $type
     */
    #[Required]
    public string $type = 'static_rendition';

    /**
     * Id identifies the Asset output, prefixed with aop_. The type field identifies the output kind.
     */
    #[Required]
    public string $id;

    /**
     * AssetId identifies the owning Asset.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * Details contains the canonical typed output resource, including its available delivery fields.
     */
    #[Required]
    public AssetStaticRendition $details;

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @var value-of<AssetOutputStatus> $status
     */
    #[Required(enum: AssetOutputStatus::class)]
    public string $status;

    /**
     * `new AssetStaticRenditionOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetStaticRenditionOutput::with(
     *   id: ..., assetID: ..., details: ..., status: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetStaticRenditionOutput)
     *   ->withID(...)
     *   ->withAssetID(...)
     *   ->withDetails(...)
     *   ->withStatus(...)
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
     * @param AssetStaticRendition|AssetStaticRenditionShape $details
     * @param AssetOutputStatus|value-of<AssetOutputStatus> $status
     */
    public static function with(
        string $id,
        string $assetID,
        AssetStaticRendition|array $details,
        AssetOutputStatus|string $status,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['assetID'] = $assetID;
        $self['details'] = $details;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Id identifies the Asset output, prefixed with aop_. The type field identifies the output kind.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * AssetId identifies the owning Asset.
     */
    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * Details contains the canonical typed output resource, including its available delivery fields.
     *
     * @param AssetStaticRendition|AssetStaticRenditionShape $details
     */
    public function withDetails(AssetStaticRendition|array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @param AssetOutputStatus|value-of<AssetOutputStatus> $status
     */
    public function withStatus(AssetOutputStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Type identifies the output kind.
     *
     * @param 'static_rendition' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
