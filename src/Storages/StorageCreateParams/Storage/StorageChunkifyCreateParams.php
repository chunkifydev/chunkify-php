<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams\Storage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\StorageCreateParams\Storage\StorageChunkifyCreateParams\Region;

/**
 * Storage parameters for Chunkify ephemeral storage.
 *
 * @phpstan-type StorageChunkifyCreateParamsShape = array{
 *   provider: 'chunkify', region: Region|value-of<Region>
 * }
 */
final class StorageChunkifyCreateParams implements BaseModel
{
    /** @use SdkModel<StorageChunkifyCreateParamsShape> */
    use SdkModel;

    /**
     * Provider specifies the storage provider.
     *
     * @var 'chunkify' $provider
     */
    #[Required]
    public string $provider = 'chunkify';

    /**
     * Region specifies the region of the storage provider.
     *
     * @var value-of<Region> $region
     */
    #[Required(enum: Region::class)]
    public string $region;

    /**
     * `new StorageChunkifyCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageChunkifyCreateParams::with(region: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageChunkifyCreateParams)->withRegion(...)
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
     * @param Region|value-of<Region> $region
     */
    public static function with(Region|string $region): self
    {
        $self = new self;

        $self['region'] = $region;

        return $self;
    }

    /**
     * Provider specifies the storage provider.
     *
     * @param 'chunkify' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Region specifies the region of the storage provider.
     *
     * @param Region|value-of<Region> $region
     */
    public function withRegion(Region|string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }
}
