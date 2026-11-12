<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\AssetOutput;

use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Details;
use Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Status;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * An Asset-owned caption output and its canonical resource details.
 *
 * @phpstan-import-type DetailsShape from \Chunkify\Assets\Outputs\AssetOutput\AssetCaptionOutput\Details
 *
 * @phpstan-type AssetCaptionOutputShape = array{
 *   id: string,
 *   assetID: string,
 *   details: Details|DetailsShape,
 *   status: Status|value-of<Status>,
 *   type: 'caption',
 * }
 */
final class AssetCaptionOutput implements BaseModel
{
    /** @use SdkModel<AssetCaptionOutputShape> */
    use SdkModel;

    /**
     * Type identifies the output kind.
     *
     * @var 'caption' $type
     */
    #[Required]
    public string $type = 'caption';

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
    public Details $details;

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new AssetCaptionOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetCaptionOutput::with(id: ..., assetID: ..., details: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetCaptionOutput)
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
     * @param Details|DetailsShape $details
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        string $assetID,
        Details|array $details,
        Status|string $status
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
     * @param Details|DetailsShape $details
     */
    public function withDetails(Details|array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Type identifies the output kind.
     *
     * @param 'caption' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
