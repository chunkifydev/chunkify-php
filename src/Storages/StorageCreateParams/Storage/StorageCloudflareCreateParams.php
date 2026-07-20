<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams\Storage;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\StorageCreateParams\Storage\StorageCloudflareCreateParams\Location;

/**
 * Storage parameters for Cloudflare R2 storage.
 *
 * @phpstan-type StorageCloudflareCreateParamsShape = array{
 *   accessKeyID: string,
 *   bucket: string,
 *   endpoint: string,
 *   location: Location|value-of<Location>,
 *   provider: 'cloudflare',
 *   region: 'auto',
 *   secretAccessKey: string,
 *   public?: bool|null,
 * }
 */
final class StorageCloudflareCreateParams implements BaseModel
{
    /** @use SdkModel<StorageCloudflareCreateParamsShape> */
    use SdkModel;

    /**
     * Provider specifies the storage provider.
     *
     * @var 'cloudflare' $provider
     */
    #[Required]
    public string $provider = 'cloudflare';

    /**
     * Region must be set to 'auto'.
     *
     * @var 'auto' $region
     */
    #[Required]
    public string $region = 'auto';

    /**
     * AccessKeyId is the access key for the storage provider.
     */
    #[Required('access_key_id')]
    public string $accessKeyID;

    /**
     * Bucket is the name of the storage bucket.
     */
    #[Required]
    public string $bucket;

    /**
     * Endpoint is the endpoint of the storage provider.
     */
    #[Required]
    public string $endpoint;

    /**
     * Location specifies the location of the storage provider.
     *
     * @var value-of<Location> $location
     */
    #[Required(enum: Location::class)]
    public string $location;

    /**
     * SecretAccessKey is the secret key for the storage provider.
     */
    #[Required('secret_access_key')]
    public string $secretAccessKey;

    /**
     * Public indicates whether the storage is publicly accessible.
     */
    #[Optional]
    public ?bool $public;

    /**
     * `new StorageCloudflareCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageCloudflareCreateParams::with(
     *   accessKeyID: ...,
     *   bucket: ...,
     *   endpoint: ...,
     *   location: ...,
     *   secretAccessKey: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageCloudflareCreateParams)
     *   ->withAccessKeyID(...)
     *   ->withBucket(...)
     *   ->withEndpoint(...)
     *   ->withLocation(...)
     *   ->withSecretAccessKey(...)
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
     * @param Location|value-of<Location> $location
     */
    public static function with(
        string $accessKeyID,
        string $bucket,
        string $endpoint,
        Location|string $location,
        string $secretAccessKey,
        ?bool $public = null,
    ): self {
        $self = new self;

        $self['accessKeyID'] = $accessKeyID;
        $self['bucket'] = $bucket;
        $self['endpoint'] = $endpoint;
        $self['location'] = $location;
        $self['secretAccessKey'] = $secretAccessKey;

        null !== $public && $self['public'] = $public;

        return $self;
    }

    /**
     * AccessKeyId is the access key for the storage provider.
     */
    public function withAccessKeyID(string $accessKeyID): self
    {
        $self = clone $this;
        $self['accessKeyID'] = $accessKeyID;

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
     * Endpoint is the endpoint of the storage provider.
     */
    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    /**
     * Location specifies the location of the storage provider.
     *
     * @param Location|value-of<Location> $location
     */
    public function withLocation(Location|string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    /**
     * Provider specifies the storage provider.
     *
     * @param 'cloudflare' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Region must be set to 'auto'.
     *
     * @param 'auto' $region
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * SecretAccessKey is the secret key for the storage provider.
     */
    public function withSecretAccessKey(string $secretAccessKey): self
    {
        $self = clone $this;
        $self['secretAccessKey'] = $secretAccessKey;

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
}
