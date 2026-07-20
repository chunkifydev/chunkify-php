<?php

declare(strict_types=1);

namespace Chunkify\Storages\Storage;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\Storage\StorageAws\Region;

/**
 * @phpstan-type StorageAwsShape = array{
 *   id: string,
 *   bucket: string,
 *   createdAt: \DateTimeInterface,
 *   provider: 'aws',
 *   public: bool,
 *   region: Region|value-of<Region>,
 *   slug: string,
 * }
 */
final class StorageAws implements BaseModel
{
    /** @use SdkModel<StorageAwsShape> */
    use SdkModel;

    /**
     * Provider specifies the storage provider.
     *
     * @var 'aws' $provider
     */
    #[Required]
    public string $provider = 'aws';

    /**
     * Unique identifier of the storage configuration.
     */
    #[Required]
    public string $id;

    /**
     * Bucket is the name of the storage bucket.
     */
    #[Required]
    public string $bucket;

    /**
     * Created at timestamp.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Public indicates whether the storage is publicly accessible.
     */
    #[Required]
    public bool $public;

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
     * `new StorageAws()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageAws::with(
     *   id: ..., bucket: ..., createdAt: ..., public: ..., region: ..., slug: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageAws)
     *   ->withID(...)
     *   ->withBucket(...)
     *   ->withCreatedAt(...)
     *   ->withPublic(...)
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
        string $bucket,
        \DateTimeInterface $createdAt,
        Region|string $region,
        string $slug,
        bool $public = false,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['bucket'] = $bucket;
        $self['createdAt'] = $createdAt;
        $self['public'] = $public;
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
     * Bucket is the name of the storage bucket.
     */
    public function withBucket(string $bucket): self
    {
        $self = clone $this;
        $self['bucket'] = $bucket;

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
     * @param 'aws' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Public indicates whether the storage is publicly accessible.
     */
    public function withPublic(bool $public): self
    {
        $self = clone $this;
        $self['public'] = $public;

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
