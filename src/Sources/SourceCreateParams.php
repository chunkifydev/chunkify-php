<?php

declare(strict_types=1);

namespace Chunkify\Sources;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create a new source from a media URL. The source will be analyzed to extract metadata and generate a thumbnail. The source will be automatically deleted after the data retention period.
 *
 * @see Chunkify\Services\SourcesService::create()
 *
 * @phpstan-type SourceCreateParamsShape = array{
 *   url: string, metadata?: array<string,string>|null
 * }
 */
final class SourceCreateParams implements BaseModel
{
    /** @use SdkModel<SourceCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Url is the URL of the source, which must be a valid HTTP URL.
     */
    #[Required]
    public string $url;

    /**
     * Metadata allows for additional information to be attached to the source, with a maximum size of 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * `new SourceCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SourceCreateParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SourceCreateParams)->withURL(...)
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
     * @param array<string,string>|null $metadata
     */
    public static function with(string $url, ?array $metadata = null): self
    {
        $self = new self;

        $self['url'] = $url;

        null !== $metadata && $self['metadata'] = $metadata;

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
}
