<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams\Storage;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Storages\StorageCreateParams\Storage\StorageS3CompatibleCreateParams\Location;

/**
 * Storage parameters for a public S3-compatible service such as MinIO, Wasabi, or Backblaze B2.
 *
 * @phpstan-type StorageS3CompatibleCreateParamsShape = array{
 *   accessKeyID: string,
 *   bucket: string,
 *   endpoint: string,
 *   location: Location|value-of<Location>,
 *   provider: 's3_compatible',
 *   region: string,
 *   secretAccessKey: string,
 *   basePrefix?: string|null,
 *   cdnBaseURL?: string|null,
 *   public?: bool|null,
 * }
 */
final class StorageS3CompatibleCreateParams implements BaseModel
{
    /** @use SdkModel<StorageS3CompatibleCreateParamsShape> */
    use SdkModel;

    /**
     * Stable provider identifier for generic S3-compatible storage.
     *
     * @var 's3_compatible' $provider
     */
    #[Required]
    public string $provider = 's3_compatible';

    /**
     * Access key for the storage provider.
     */
    #[Required('access_key_id')]
    public string $accessKeyID;

    /**
     * Bucket is the name of the storage bucket.
     */
    #[Required]
    public string $bucket;

    /**
     * Public HTTPS origin for the S3-compatible service. Credentials, paths, queries, fragments, and non-public destinations are rejected.
     */
    #[Required]
    public string $endpoint;

    /**
     * Chunkify workload location. It controls where Chunkify processes the workload and is independent from the provider region.
     *
     * @var value-of<Location> $location
     */
    #[Required(enum: Location::class)]
    public string $location;

    /**
     * Explicit provider region used for S3 request signing. Vendor-specific identifiers are accepted.
     */
    #[Required]
    public string $region;

    /**
     * Secret key for the storage provider.
     */
    #[Required('secret_access_key')]
    public string $secretAccessKey;

    /**
     * Object-key prefix for final job outputs. The API normalizes it without a leading slash and with one trailing slash. Omit it or send an empty string to use the bucket root.
     */
    #[Optional('base_prefix')]
    public ?string $basePrefix;

    /**
     * Optional customer-managed HTTPS delivery origin. It must not contain credentials, a path, query string, or fragment.
     */
    #[Optional('cdn_base_url', nullable: true)]
    public ?string $cdnBaseURL;

    /**
     * Whether the bucket is publicly readable.
     */
    #[Optional]
    public ?bool $public;

    /**
     * `new StorageS3CompatibleCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StorageS3CompatibleCreateParams::with(
     *   accessKeyID: ...,
     *   bucket: ...,
     *   endpoint: ...,
     *   location: ...,
     *   region: ...,
     *   secretAccessKey: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StorageS3CompatibleCreateParams)
     *   ->withAccessKeyID(...)
     *   ->withBucket(...)
     *   ->withEndpoint(...)
     *   ->withLocation(...)
     *   ->withRegion(...)
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
        string $region,
        string $secretAccessKey,
        ?string $basePrefix = null,
        ?string $cdnBaseURL = null,
        ?bool $public = null,
    ): self {
        $self = new self;

        $self['accessKeyID'] = $accessKeyID;
        $self['bucket'] = $bucket;
        $self['endpoint'] = $endpoint;
        $self['location'] = $location;
        $self['region'] = $region;
        $self['secretAccessKey'] = $secretAccessKey;

        null !== $basePrefix && $self['basePrefix'] = $basePrefix;
        null !== $cdnBaseURL && $self['cdnBaseURL'] = $cdnBaseURL;
        null !== $public && $self['public'] = $public;

        return $self;
    }

    /**
     * Access key for the storage provider.
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
     * Public HTTPS origin for the S3-compatible service. Credentials, paths, queries, fragments, and non-public destinations are rejected.
     */
    public function withEndpoint(string $endpoint): self
    {
        $self = clone $this;
        $self['endpoint'] = $endpoint;

        return $self;
    }

    /**
     * Chunkify workload location. It controls where Chunkify processes the workload and is independent from the provider region.
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
     * Stable provider identifier for generic S3-compatible storage.
     *
     * @param 's3_compatible' $provider
     */
    public function withProvider(string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Explicit provider region used for S3 request signing. Vendor-specific identifiers are accepted.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * Secret key for the storage provider.
     */
    public function withSecretAccessKey(string $secretAccessKey): self
    {
        $self = clone $this;
        $self['secretAccessKey'] = $secretAccessKey;

        return $self;
    }

    /**
     * Object-key prefix for final job outputs. The API normalizes it without a leading slash and with one trailing slash. Omit it or send an empty string to use the bucket root.
     */
    public function withBasePrefix(string $basePrefix): self
    {
        $self = clone $this;
        $self['basePrefix'] = $basePrefix;

        return $self;
    }

    /**
     * Optional customer-managed HTTPS delivery origin. It must not contain credentials, a path, query string, or fragment.
     */
    public function withCdnBaseURL(?string $cdnBaseURL): self
    {
        $self = clone $this;
        $self['cdnBaseURL'] = $cdnBaseURL;

        return $self;
    }

    /**
     * Whether the bucket is publicly readable.
     */
    public function withPublic(bool $public): self
    {
        $self = clone $this;
        $self['public'] = $public;

        return $self;
    }
}
