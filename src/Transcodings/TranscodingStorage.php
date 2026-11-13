<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;

/**
 * The resolved output destination for a Transcoding.
 *
 * @phpstan-type TranscodingStorageShape = array{id: string, path: string}
 */
final class TranscodingStorage implements BaseModel
{
    /** @use SdkModel<TranscodingStorageShape> */
    use SdkModel;

    /**
     * Id identifies the output Storage.
     */
    #[Required]
    public string $id;

    /**
     * Path specifies the output file path relative to the Storage base_prefix saved at creation.
     */
    #[Required]
    public string $path;

    /**
     * `new TranscodingStorage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscodingStorage::with(id: ..., path: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscodingStorage)->withID(...)->withPath(...)
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
     */
    public static function with(string $id, string $path): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['path'] = $path;

        return $self;
    }

    /**
     * Id identifies the output Storage.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Path specifies the output file path relative to the Storage base_prefix saved at creation.
     */
    public function withPath(string $path): self
    {
        $self = clone $this;
        $self['path'] = $path;

        return $self;
    }
}
