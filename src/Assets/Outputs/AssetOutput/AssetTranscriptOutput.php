<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\AssetOutput;

use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details;
use Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Status;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * An Asset-owned transcript output and its content.
 *
 * @phpstan-import-type DetailsShape from \Chunkify\Assets\Outputs\AssetOutput\AssetTranscriptOutput\Details
 *
 * @phpstan-type AssetTranscriptOutputShape = array{
 *   id: string,
 *   assetID: string,
 *   details: Details|DetailsShape,
 *   status: Status|value-of<Status>,
 *   type: 'transcript',
 * }
 */
final class AssetTranscriptOutput implements BaseModel
{
    /** @use SdkModel<AssetTranscriptOutputShape> */
    use SdkModel;

    /**
     * Type identifies the output kind.
     *
     * @var 'transcript' $type
     */
    #[Required]
    public string $type = 'transcript';

    /**
     * Id identifies the Asset output, prefixed with aop_.
     */
    #[Required]
    public string $id;

    /**
     * AssetId identifies the owning Asset.
     */
    #[Required('asset_id')]
    public string $assetID;

    /**
     * An original-language transcript. Content is included in ready output responses and lifecycle event snapshots. Transcripts have no download or CDN URL.
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
     * `new AssetTranscriptOutput()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetTranscriptOutput::with(id: ..., assetID: ..., details: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetTranscriptOutput)
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
     * Id identifies the Asset output, prefixed with aop_.
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
     * An original-language transcript. Content is included in ready output responses and lifecycle event snapshots. Transcripts have no download or CDN URL.
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
     * @param 'transcript' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
