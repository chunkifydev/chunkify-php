<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\StorageCreateParams\Storage;
use Chunkify\Storages\StorageCreateParams\Storage\StorageAwsCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageChunkifyCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageCloudflareCreateParams;
use Chunkify\Storages\StorageCreateParams\Storage\StorageS3CompatibleCreateParams;

/**
 * Create a new storage configuration for cloud storage providers like AWS S3, Cloudflare R2, etc. The storage credentials will be validated before saving.
 *
 * @see Chunkify\Services\StoragesService::create()
 *
 * @phpstan-import-type StorageVariants from \Chunkify\Storages\StorageCreateParams\Storage
 * @phpstan-import-type StorageShape from \Chunkify\Storages\StorageCreateParams\Storage
 *
 * @phpstan-type StorageCreateParamsShape = array{storage: StorageShape}
 */
final class StorageCreateParams implements BaseModel
{
    /** @use SdkModel<StorageCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The parameters for creating a new storage configuration.
     *
     * @var StorageVariants $storage
     */
    #[Required(union: Storage::class)]
    public StorageAwsCreateParams|StorageChunkifyCreateParams|StorageCloudflareCreateParams|StorageS3CompatibleCreateParams $storage;

    /**
     * `new StorageCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageCreateParams::with(storage: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageCreateParams)->withStorage(...)
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
     * @param StorageShape $storage
     */
    public static function with(
        StorageAwsCreateParams|array|StorageChunkifyCreateParams|StorageCloudflareCreateParams|StorageS3CompatibleCreateParams $storage,
    ): self {
        $self = new self;

        $self['storage'] = $storage;

        return $self;
    }

    /**
     * The parameters for creating a new storage configuration.
     *
     * @param StorageShape $storage
     */
    public function withStorage(
        StorageAwsCreateParams|array|StorageChunkifyCreateParams|StorageCloudflareCreateParams|StorageS3CompatibleCreateParams $storage,
    ): self {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }
}
