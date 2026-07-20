<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Response containing the list of storages configurations for a project.
 *
 * @phpstan-import-type StorageVariants from \Chunkify\Storages\Storage
 * @phpstan-import-type StorageShape from \Chunkify\Storages\Storage
 *
 * @phpstan-type StorageListResponseShape = array{
 *   data: list<StorageShape>, status: 'success'
 * }
 */
final class StorageListResponse implements BaseModel
{
    /** @use SdkModel<StorageListResponseShape> */
    use SdkModel;

    /**
     * Status indicates the response status "success".
     *
     * @var 'success' $status
     */
    #[Required]
    public string $status = 'success';

    /**
     * Data contains the storage items.
     *
     * @var list<StorageVariants> $data
     */
    #[Required(list: Storage::class)]
    public array $data;

    /**
     * `new StorageListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageListResponse::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageListResponse)->withData(...)
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
     * @param list<StorageShape> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * Data contains the storage items.
     *
     * @param list<StorageShape> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Status indicates the response status "success".
     *
     * @param 'success' $status
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
