<?php

declare(strict_types=1);

namespace Chunkify\Thumbnails;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Delete a ready, failed or expired Thumbnail after all workers have stopped. The Source and settled usage are preserved. Files remain unless delete_files is true; temporary files retain their original 24-hour expiry. Deletion remains available for inactive teams.
 *
 * @see Chunkify\Services\ThumbnailsService::delete()
 *
 * @phpstan-type ThumbnailDeleteParamsShape = array{deleteFiles?: bool|null}
 */
final class ThumbnailDeleteParams implements BaseModel
{
    /** @use SdkModel<ThumbnailDeleteParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * DeleteFiles specifies whether to permanently delete this Thumbnail's owned images, sprite sheets, VTT and partial outputs at their saved storage prefix. Defaults to false. The Source and unrelated files are preserved. If deletion fails, records remain for retry, but some files may already be deleted. Temporary outputs still expire when this option is false.
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
     * DeleteFiles specifies whether to permanently delete this Thumbnail's owned images, sprite sheets, VTT and partial outputs at their saved storage prefix. Defaults to false. The Source and unrelated files are preserved. If deletion fails, records remain for retry, but some files may already be deleted. Temporary outputs still expire when this option is false.
     */
    public function withDeleteFiles(bool $deleteFiles): self
    {
        $self = clone $this;
        $self['deleteFiles'] = $deleteFiles;

        return $self;
    }
}
