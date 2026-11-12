<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Delete one output belonging to this Asset and Project. Its type is resolved from the output ID. Type-specific processing and dependency restrictions still apply.
 *
 * @see Chunkify\Services\Assets\OutputsService::delete()
 *
 * @phpstan-type OutputDeleteParamsShape = array{
 *   assetID: string, deleteFiles?: bool|null
 * }
 */
final class OutputDeleteParams implements BaseModel
{
    /** @use SdkModel<OutputDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $assetID;

    /**
     * DeleteFiles specifies whether to remove this output's published media files from Storage. Defaults to false, preserving those files. Transcript deletion always schedules removal of its private text and saved subtitle copy, regardless of this option. The Asset, Source, and other outputs are preserved. File cleanup failures retain the output record for retry; files already removed cannot be restored.
     */
    #[Optional]
    public ?bool $deleteFiles;

    /**
     * `new OutputDeleteParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OutputDeleteParams::with(assetID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OutputDeleteParams)->withAssetID(...)
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
     */
    public static function with(string $assetID, ?bool $deleteFiles = null): self
    {
        $self = new self;

        $self['assetID'] = $assetID;

        null !== $deleteFiles && $self['deleteFiles'] = $deleteFiles;

        return $self;
    }

    public function withAssetID(string $assetID): self
    {
        $self = clone $this;
        $self['assetID'] = $assetID;

        return $self;
    }

    /**
     * DeleteFiles specifies whether to remove this output's published media files from Storage. Defaults to false, preserving those files. Transcript deletion always schedules removal of its private text and saved subtitle copy, regardless of this option. The Asset, Source, and other outputs are preserved. File cleanup failures retain the output record for retry; files already removed cannot be restored.
     */
    public function withDeleteFiles(bool $deleteFiles): self
    {
        $self = clone $this;
        $self['deleteFiles'] = $deleteFiles;

        return $self;
    }
}
