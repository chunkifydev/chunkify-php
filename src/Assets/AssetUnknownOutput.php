<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * An output kind not recognized by this client. Clients may ignore its details.
 *
 * @phpstan-type AssetUnknownOutputShape = array{
 *   id: string,
 *   assetID: string,
 *   details: array<string,mixed>,
 *   status: AssetOutputStatus|value-of<AssetOutputStatus>,
 *   type: string,
 * }
 */
final class AssetUnknownOutput implements BaseModel
{
    /** @use SdkModel<AssetUnknownOutputShape> */
    use SdkModel;

    /**
     * Id identifies the output resource.
     */
    #[Required]
    public string $id;

    /**
     * AssetId identifies the owning Asset.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * Details contains fields defined by the output kind.
     *
     * @var array<string,mixed> $details
     */
    #[Required(map: 'mixed')]
    public array $details;

    /**
     * Status specifies the output processing state. Expired means temporary output files are no longer available.
     *
     * @var value-of<AssetOutputStatus> $status
     */
    #[Required(enum: AssetOutputStatus::class)]
    public string $status;

    /**
     * Type identifies the output kind.
     */
    #[Required]
    public string $type;

    /**
     * `new AssetUnknownOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetUnknownOutput::with(
     *   id: ..., assetID: ..., details: ..., status: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetUnknownOutput)
     *   ->withID(...)
     *   ->withAssetID(...)
     *   ->withDetails(...)
     *   ->withStatus(...)
     *   ->withType(...)
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
     * @param array<string,mixed> $details
     * @param AssetOutputStatus|value-of<AssetOutputStatus> $status
     */
    public static function with(
        string $id,
        string $assetID,
        array $details,
        AssetOutputStatus|string $status,
        string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['assetID'] = $assetID;
        $self['details'] = $details;
        $self['status'] = $status;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Id identifies the output resource.
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
     * Details contains fields defined by the output kind.
     *
     * @param array<string,mixed> $details
     */
    public function withDetails(array $details): self
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
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
