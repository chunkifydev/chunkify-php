<?php

declare(strict_types=1);

namespace Chunkify\Services;

use Chunkify\Client;
use Chunkify\Core\Exceptions\APIException;
use Chunkify\Core\Omit;
use Chunkify\RequestOptions;
use Chunkify\ServiceContracts\StoragesContract;
use Chunkify\Storages\StorageAws;
use Chunkify\Storages\StorageAwsCreateParams;
use Chunkify\Storages\StorageChunkify;
use Chunkify\Storages\StorageChunkifyCreateParams;
use Chunkify\Storages\StorageCloudflare;
use Chunkify\Storages\StorageCloudflareCreateParams;
use Chunkify\Storages\StorageListResponse;
use Chunkify\Storages\StorageS3Compatible;
use Chunkify\Storages\StorageS3CompatibleCreateParams;

/**
 * @phpstan-import-type StorageShape from \Chunkify\Storages\StorageCreateParams\Storage
 * @phpstan-import-type RequestOpts from \Chunkify\RequestOptions
 */
final class StoragesService implements StoragesContract
{
    /**
     * @api
     */
    public StoragesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new StoragesRawService($client);
    }

    /**
     * @api
     *
     * Create a new storage configuration for cloud storage providers like AWS S3, Cloudflare R2, etc. The storage credentials will be validated before saving.
     *
     * @param StorageShape $storage the parameters for creating a new storage configuration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        StorageAwsCreateParams|array|StorageChunkifyCreateParams|StorageCloudflareCreateParams|StorageS3CompatibleCreateParams $storage,
        RequestOptions|array|null $requestOptions = null,
    ): StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible {
        $params = [];
        $params['storage'] = $storage;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve details of a specific storage configuration by its id.
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($storageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update customer-owned storage settings. Send access_key_id and secret_access_key together to rotate credentials for AWS S3, Cloudflare R2, or S3-compatible storage. Both values must be non-empty and non-null. Omitting both preserves the saved pair and skips connection validation. Replacement credentials are checked against the saved bucket, endpoint, region, and addressing style using the creation upload, metadata, and download checks with best-effort probe cleanup. A prefix changed in the same request is used for validation. Both credentials are encrypted and saved atomically with other settings; a failed update preserves the previous values. Credential-only updates keep the Storage ID, resource associations, object paths, and Project default. Subsequent storage lookups use the new pair; running work may retain an existing client or signed URL. Rotation does not renew issued URLs, and revoking old keys can invalidate them. Prefix changes apply to final outputs that have not been uploaded yet. Existing files keep their stored object keys.
     *
     * @param string $storageID Storage id
     * @param string $accessKeyID Replacement access key ID for customer-managed storage. Send with a non-empty secret_access_key. Omit both credential fields to keep the saved pair. Null and empty values are rejected. Credentials are validated before either value is saved and are never returned.
     * @param string $basePrefix Object-key prefix for future final job outputs. Existing files keep their stored object keys. Send an empty string to use the bucket root.
     * @param string|Omit|null $cdnBaseURL customer-managed HTTPS delivery origin, or null to remove the current value
     * @param string $secretAccessKey Replacement secret access key. Required with access_key_id; cannot be null or empty. The pair is encrypted and saved atomically only after validation succeeds.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $storageID,
        ?string $accessKeyID = null,
        ?string $basePrefix = null,
        string|Omit|null $cdnBaseURL = Omit::Value,
        ?string $secretAccessKey = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = [];
        null !== $accessKeyID && $params['accessKeyID'] = $accessKeyID;
        null !== $basePrefix && $params['basePrefix'] = $basePrefix;
        Omit::Value !== $cdnBaseURL && $params['cdnBaseURL'] = $cdnBaseURL;
        null !== $secretAccessKey && $params['secretAccessKey'] = $secretAccessKey;

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($storageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a list of all storage configurations for the current project.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): StorageListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Delete a storage configuration. The storage must not be currently attached to the project.
     *
     * @param string $storageID Storage id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $storageID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($storageID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
