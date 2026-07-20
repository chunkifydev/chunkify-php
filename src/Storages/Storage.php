<?php

declare(strict_types=1);

namespace Chunkify\Storages;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Storages\Storage\StorageAws;
use Chunkify\Storages\Storage\StorageChunkify;
use Chunkify\Storages\Storage\StorageCloudflare;

/**
 * @phpstan-import-type StorageChunkifyShape from \Chunkify\Storages\Storage\StorageChunkify
 * @phpstan-import-type StorageCloudflareShape from \Chunkify\Storages\Storage\StorageCloudflare
 * @phpstan-import-type StorageAwsShape from \Chunkify\Storages\Storage\StorageAws
 *
 * @phpstan-type StorageVariants = StorageChunkify|StorageCloudflare|StorageAws
 * @phpstan-type StorageShape = StorageVariants|StorageChunkifyShape|StorageCloudflareShape|StorageAwsShape
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
        ];
    }
}
