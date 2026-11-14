<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Storages\StorageAwsCreateParams;
use Chunkify\Storages\StorageChunkifyCreateParams;
use Chunkify\Storages\StorageCloudflareCreateParams;
use Chunkify\Storages\StorageS3CompatibleCreateParams;

/**
 * The parameters for creating a new storage configuration.
 *
 * @phpstan-import-type StorageAwsCreateParamsShape from \Chunkify\Storages\StorageAwsCreateParams
 * @phpstan-import-type StorageChunkifyCreateParamsShape from \Chunkify\Storages\StorageChunkifyCreateParams
 * @phpstan-import-type StorageCloudflareCreateParamsShape from \Chunkify\Storages\StorageCloudflareCreateParams
 * @phpstan-import-type StorageS3CompatibleCreateParamsShape from \Chunkify\Storages\StorageS3CompatibleCreateParams
 *
 * @phpstan-type StorageVariants = StorageAwsCreateParams|StorageChunkifyCreateParams|StorageCloudflareCreateParams|StorageS3CompatibleCreateParams
 * @phpstan-type StorageShape = StorageVariants|StorageAwsCreateParamsShape|StorageChunkifyCreateParamsShape|StorageCloudflareCreateParamsShape|StorageS3CompatibleCreateParamsShape
 */
final class Storage implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'provider';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'aws' => StorageAwsCreateParams::class,
            'chunkify' => StorageChunkifyCreateParams::class,
            'cloudflare' => StorageCloudflareCreateParams::class,
            's3_compatible' => StorageS3CompatibleCreateParams::class,
        ];
    }
}
