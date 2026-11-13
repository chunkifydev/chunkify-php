<?php

declare(strict_types=1);

namespace Chunkify\Transcodings;

use Chunkify\Core\Attributes\Optional;
use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Concerns\SdkParams;
use Chunkify\Core\Contracts\BaseModel;

/**
 * Create a standalone file export with resolved encoding settings.
 *
 * @see Chunkify\Services\TranscodingsService::create()
 *
 * @phpstan-import-type TranscodingCreateFormatParamsVariants from \Chunkify\Transcodings\TranscodingCreateFormatParams
 * @phpstan-import-type TranscodingCreateFormatParamsShape from \Chunkify\Transcodings\TranscodingCreateFormatParams
 * @phpstan-import-type TranscodingCreateStorageParamsShape from \Chunkify\Transcodings\TranscodingCreateStorageParams
 *
 * @phpstan-type TranscodingCreateParamsShape = array{
 *   format: TranscodingCreateFormatParamsShape,
 *   sourceID: string,
 *   metadata?: array<string,string>|null,
 *   storage?: null|TranscodingCreateStorageParams|TranscodingCreateStorageParamsShape,
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
     * @var TranscodingCreateFormatParamsVariants $format
     */
    #[Required(union: TranscodingCreateFormatParams::class)]
    public TranscodingMP4H264|TranscodingMP4H265|TranscodingMP4Av1|TranscodingWebmVp9|TranscodingM4aAac $format;

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
    public ?TranscodingCreateStorageParams $storage;

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
     * @param TranscodingCreateFormatParamsShape $format
     * @param array<string,string>|null $metadata
     * @param TranscodingCreateStorageParams|TranscodingCreateStorageParamsShape|null $storage
     */
    public static function with(
        TranscodingMP4H264|array|TranscodingMP4H265|TranscodingMP4Av1|TranscodingWebmVp9|TranscodingM4aAac $format,
        string $sourceID,
        ?array $metadata = null,
        TranscodingCreateStorageParams|array|null $storage = null,
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
     * @param TranscodingCreateFormatParamsShape $format
     */
    public function withFormat(
        TranscodingMP4H264|array|TranscodingMP4H265|TranscodingMP4Av1|TranscodingWebmVp9|TranscodingM4aAac $format,
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
     * @param TranscodingCreateStorageParams|TranscodingCreateStorageParamsShape $storage
     */
    public function withStorage(
        TranscodingCreateStorageParams|array $storage
    ): self {
        $self = clone $this;
        $self['storage'] = $storage;

        return $self;
    }
}
