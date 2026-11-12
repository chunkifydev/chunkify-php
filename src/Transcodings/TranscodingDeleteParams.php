<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Delete a ready, failed, cancelled or expired Transcoding and its file records. The Source and settled usage are preserved. Customer output files remain unless delete_files is true; temporary files retain their original 24-hour expiry. Deletion remains available for inactive teams.
 *
 * @see Chunkify\Services\TranscodingsService::delete()
 *
 * @phpstan-type TranscodingDeleteParamsShape = array{deleteFiles?: bool|null}
 */
final class TranscodingDeleteParams implements BaseModel
{
    /** @use SdkModel<TranscodingDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * DeleteFiles specifies whether to permanently delete this Transcoding's output files at their saved storage paths. Defaults to false. The original Source and unrelated files are preserved. If deletion fails, records remain for retry, but some files may already be deleted. Managed dashboard images are removed with the resource; temporary outputs still expire after 24 hours when this option is false.
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
     * DeleteFiles specifies whether to permanently delete this Transcoding's output files at their saved storage paths. Defaults to false. The original Source and unrelated files are preserved. If deletion fails, records remain for retry, but some files may already be deleted. Managed dashboard images are removed with the resource; temporary outputs still expire after 24 hours when this option is false.
     */
    public function withDeleteFiles(bool $deleteFiles): self
    {
        $self = clone $this;
        $self['deleteFiles'] = $deleteFiles;

        return $self;
    }
}
