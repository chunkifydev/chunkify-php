<?php

declare(strict_types=1);

namespace Chunkify\Sources;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Sources\SourceCreateParams\Storage;

/**
 * Create a new source from a media URL. The source will be analyzed to extract metadata and generate a thumbnail. The source will be automatically deleted after the data retention period.
 *
 * @see Chunkify\Services\SourcesService::create()
 *
 * @phpstan-import-type StorageShape from \Chunkify\Sources\SourceCreateParams\Storage
 *
 * @phpstan-type SourceCreateParamsShape = array{
 *   metadata?: array<string,string>|null,
 *   storage?: null|Storage|StorageShape,
 *   url?: string|null,
 * }
 */
final class SourceCreateParams implements BaseModel
{
    /** @use SdkModel<SourceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Metadata allows for additional information to be attached to the source, with a maximum size of 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Storage input configuration. Provide this or url, never both.
     */
    #[Optional]
    public ?Storage $storage;

    /**
     * Url is the URL of the source, which must be a valid HTTP URL.
     */
    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,string>|null $metadata
     * @param Storage|StorageShape|null $storage
     */
    public static function with(
        ?array $metadata = null,
        Storage|array|null $storage = null,
        ?string $url = null
    ): self {
        $self = new self;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $storage && $self['storage'] = $storage;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    /**
     * Metadata allows for additional information to be attached to the source, with a maximum size of 2048 bytes.
     *
     * @param array<string,string> $metadata
     */
    public function withMetadata(array $metadata): self
    {
        $self = clone $this;
        $self['metadata'] = $metadata;

        return $self;
    }

    /**
     * Storage input configuration. Provide this or url, never both.
     *
     * @param Storage|StorageShape $storage
     */
    public function withStorage(Storage|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }

    /**
     * Url is the URL of the source, which must be a valid HTTP URL.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
