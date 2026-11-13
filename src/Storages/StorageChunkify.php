<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * @phpstan-type StorageChunkifyShape = array{
 *   id: string,
 *   createdAt: \DateTimeInterface,
 *   provider: 'chunkify',
 *   region: ChunkifyRegion|value-of<ChunkifyRegion>,
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
     * @var value-of<ChunkifyRegion> $region
     */
    #[Required(enum: ChunkifyRegion::class)]
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
     * @param ChunkifyRegion|value-of<ChunkifyRegion> $region
     */
    public static function with(
        string $id,
        \DateTimeInterface $createdAt,
        ChunkifyRegion|string $region,
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
     * @param ChunkifyRegion|value-of<ChunkifyRegion> $region
     */
    public function withRegion(ChunkifyRegion|string $region): self
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
