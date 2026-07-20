<?php

declare(strict_types=1);

namespace Chunkify\Storages\Storage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\Storage\StorageChunkify\Region;

/**
 * @phpstan-type StorageChunkifyShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   provider: 'chunkify',
 *   region: Region|value-of<Region>,
 *   slug: string,
 * }
 */
final class StorageChunkify implements BaseModel
{
    /** @use SdkModel<StorageChunkifyShape> */
    use SdkModel;

    /**
     * Provider specifies the storage provider.
     *
     * @var 'chunkify' $provider
     */
    #[Required]
    public string $provider = 'chunkify';

    /**
     * Unique identifier of the storage configuration.
     */
    #[Required]
    public string $id;

    /**
     * Created at timestamp.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Region specifies the region of the storage provider.
     *
     * @var value-of<Region> $region
     */
    #[Required(enum: Region::class)]
    public string $region;

    /**
     * Unique identifier of the storage configuration.
     */
    #[Required]
    public string $slug;

    /**
     * `new StorageChunkify()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageChunkify::with(id: ..., createdAt: ..., region: ..., slug: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageChunkify)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withRegion(...)
     *   ->withSlug(...)
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
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        Region|string $region,
        string $slug,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['region'] = $region;
        $self['slug'] = $slug;

        return $self;
    }

    /**
     * Unique identifier of the storage configuration.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Created at timestamp.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

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

    /**
     * Unique identifier of the storage configuration.
     */
    public function withSlug(string $slug): self
    {
        $self = clone $this;
        $self['slug'] = $slug;

        return $self;
    }
}
