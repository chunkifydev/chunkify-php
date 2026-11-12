<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Transcodings\TranscodingCreateParams\Format;
use Chunkify\Transcodings\TranscodingCreateParams\Format\M4aAac;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4Av1;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H264;
use Chunkify\Transcodings\TranscodingCreateParams\Format\MP4H265;
use Chunkify\Transcodings\TranscodingCreateParams\Format\WebmVp9;
use Chunkify\Transcodings\TranscodingCreateParams\Storage;

/**
 * Create a standalone file export with resolved encoding settings.
 *
 * @see Chunkify\Services\TranscodingsService::create()
 *
 * @phpstan-import-type FormatVariants from \Chunkify\Transcodings\TranscodingCreateParams\Format
 * @phpstan-import-type FormatShape from \Chunkify\Transcodings\TranscodingCreateParams\Format
 * @phpstan-import-type StorageShape from \Chunkify\Transcodings\TranscodingCreateParams\Storage
 *
 * @phpstan-type TranscodingCreateParamsShape = array{
 *   format: FormatShape,
 *   sourceID: string,
 *   metadata?: array<string,string>|null,
 *   storage?: null|Storage|StorageShape,
 * }
 */
final class TranscodingCreateParams implements BaseModel
{
    /** @use SdkModel<TranscodingCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Format specifies the requested encoding settings.
     *
     * @var FormatVariants $format
     */
    #[Required(union: Format::class)]
    public MP4H264|MP4H265|MP4Av1|WebmVp9|M4aAac $format;

    /**
     * SourceId identifies a Source in this Project.
     */
    #[Required('source_id')]
    public string $sourceID;

    /**
     * Metadata attaches string values to the Transcoding. The serialized object may contain at most 2048 bytes.
     *
     * @var array<string,string>|null $metadata
     */
    #[Optional(map: 'string')]
    public ?array $metadata;

    /**
     * Storage overrides the Project output destination. Source storage remains independent.
     */
    #[Optional]
    public ?Storage $storage;

    /**
     * `new TranscodingCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TranscodingCreateParams::with(format: ..., sourceID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TranscodingCreateParams)->withFormat(...)->withSourceID(...)
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
     * @param FormatShape $format
     * @param array<string,string>|null $metadata
     * @param Storage|StorageShape|null $storage
     */
    public static function with(
        MP4H264|array|MP4H265|MP4Av1|WebmVp9|M4aAac $format,
        string $sourceID,
        ?array $metadata = null,
        Storage|array|null $storage = null,
    ): self {
        $self = new self;

        $self['format'] = $format;
        $self['sourceID'] = $sourceID;

        null !== $metadata && $self['metadata'] = $metadata;
        null !== $storage && $self['storage'] = $storage;

        return $self;
    }

    /**
     * Format specifies the requested encoding settings.
     *
     * @param FormatShape $format
     */
    public function withFormat(
        MP4H264|array|MP4H265|MP4Av1|WebmVp9|M4aAac $format
    ): self {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }

    /**
     * SourceId identifies a Source in this Project.
     */
    public function withSourceID(string $sourceID): self
    {
        $self = clone $this;
        $self['sourceID'] = $sourceID;

        return $self;
    }

    /**
     * Metadata attaches string values to the Transcoding. The serialized object may contain at most 2048 bytes.
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
     * Storage overrides the Project output destination. Source storage remains independent.
     *
     * @param Storage|StorageShape $storage
     */
    public function withStorage(Storage|array $storage): self
    {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }
}
