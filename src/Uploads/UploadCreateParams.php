<?php

declare(strict_types=1);

namespace Chunkify\Uploads;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Uploads\UploadCreateParams\Storage;

/**
 * Create a new upload with the specified name.
 *
 * @see Chunkify\Services\UploadsService::create()
 *
 * @phpstan-import-type StorageShape from \Chunkify\Uploads\UploadCreateParams\Storage
 *
 * @phpstan-type UploadCreateParamsShape = array{
 *   metadata?: array<string,string>|null,
 *   storage?: null|Storage|StorageShape,
 *   validityTimeout?: int|null,
 * }
 */
final class UploadCreateParams implements BaseModel
{
    /** @use SdkModel<UploadCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
     */
    #[Optional]
    public ?Storage $storage;

    /**
     * Both the file PUT and completion POST must finish within this timeout in seconds.
     */
    #[Optional('validity_timeout')]
    public ?int $validityTimeout;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,string>|null $metadata
     * @param Storage|StorageShape|null $storage
     */
    public static function with(
        ?array $metadata = null,
        Storage|array|null $storage = null,
        ?int $validityTimeout = null,
    ): self {
        $self = new self;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $storage && $self['storage'] = $storage;
        null !== $validityTimeout && $self['validityTimeout'] = $validityTimeout;

        return $self;
    }

    /**
     * Metadata allows for additional information to be attached to the upload, with a maximum size of 2048 bytes.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Optional Storage override. Omit id to use the Project default. Customer-connected Storage requires path; Chunkify Storage generates its own path.
     *
     * @param Storage|StorageShape $storage
     */
    public function withStorage(Storage|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    /**
     * Both the file PUT and completion POST must finish within this timeout in seconds.
     */
    public function withValidityTimeout(int $validityTimeout): self
    {
        $self = clone $this;
        $self['validityTimeout'] = $validityTimeout;

        return $self;
    }
}
