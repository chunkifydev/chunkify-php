<?php

declare(strict_types=1);

namespace Chunkify\Assets;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Delete an Asset after all processing finishes. Files remain in Storage unless delete_files is true.
 *
 * @see Chunkify\Services\AssetsService::delete()
 *
 * @phpstan-type AssetDeleteParamsShape = array{deleteFiles?: bool|null}
 */
final class AssetDeleteParams implements BaseModel
{
    /** @use SdkModel<AssetDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Also delete all files under the Asset's storage prefix, including streaming and static outputs. Other files and the original input are preserved. Defaults to false, which preserves published media files. Private transcript text and saved subtitle copies are always scheduled for removal. File deletion is irreversible. If cleanup fails, records remain for retry, but files may already be deleted.
     */
    #[Optional]
    public ?bool $deleteFiles;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $deleteFiles = null): self
    {
        $self = new self;

        null !== $deleteFiles && $self['deleteFiles'] = $deleteFiles;

        return $self;
    }

    /**
     * Also delete all files under the Asset's storage prefix, including streaming and static outputs. Other files and the original input are preserved. Defaults to false, which preserves published media files. Private transcript text and saved subtitle copies are always scheduled for removal. File deletion is irreversible. If cleanup fails, records remain for retry, but files may already be deleted.
     */
    public function withDeleteFiles(bool $deleteFiles): self
    {
        $self = clone $this;
        $self['deleteFiles'] = $deleteFiles;

        return $self;
    }
}
