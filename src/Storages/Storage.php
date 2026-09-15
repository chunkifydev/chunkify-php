<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Storages\Storage\StorageAws;
use Chunkify\Storages\Storage\StorageChunkify;
use Chunkify\Storages\Storage\StorageCloudflare;
use Chunkify\Storages\Storage\StorageS3Compatible;

/**
 * A customer-owned storage connection using the standard S3 API.
 *
 * @phpstan-import-type StorageChunkifyShape from \Chunkify\Storages\Storage\StorageChunkify
 * @phpstan-import-type StorageCloudflareShape from \Chunkify\Storages\Storage\StorageCloudflare
 * @phpstan-import-type StorageAwsShape from \Chunkify\Storages\Storage\StorageAws
 * @phpstan-import-type StorageS3CompatibleShape from \Chunkify\Storages\Storage\StorageS3Compatible
 *
 * @phpstan-type StorageVariants = StorageChunkify|StorageCloudflare|StorageAws|StorageS3Compatible
 * @phpstan-type StorageShape = StorageVariants|StorageChunkifyShape|StorageCloudflareShape|StorageAwsShape|StorageS3CompatibleShape
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
            'chunkify' => StorageChunkify::class,
            'cloudflare' => StorageCloudflare::class,
            'aws' => StorageAws::class,
            's3_compatible' => StorageS3Compatible::class,
        ];
    }
}
