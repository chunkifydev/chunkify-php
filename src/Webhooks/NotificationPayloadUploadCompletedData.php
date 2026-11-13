<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Sources\Source;
use Chunkify\Uploads\Upload;

/**
 * Payload data structure for upload.completed events.
 *
 * @phpstan-import-type SourceShape from \Chunkify\Sources\Source
 * @phpstan-import-type UploadShape from \Chunkify\Uploads\Upload
 *
 * @phpstan-type NotificationPayloadUploadCompletedDataShape = array{
 *   source: Source|SourceShape, upload: Upload|UploadShape
 * }
 */
final class NotificationPayloadUploadCompletedData implements BaseModel
{
    /** @use SdkModel<NotificationPayloadUploadCompletedDataShape> */
    use SdkModel;

    #[Required]
    public Source $source;

    #[Required]
    public Upload $upload;

    /**
     * `new NotificationPayloadUploadCompletedData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadUploadCompletedData::with(source: ..., upload: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadUploadCompletedData)->withSource(...)->withUpload(...)
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
     * @param Source|SourceShape $source
     * @param Upload|UploadShape $upload
     */
    public static function with(
        Source|array $source,
        Upload|array $upload
    ): self {
        $self = new self;

        $self['source'] = $source;
        $self['upload'] = $upload;

        return $self;
    }

    /**
     * @param Source|SourceShape $source
     */
    public function withSource(Source|array $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * @param Upload|UploadShape $upload
     */
    public function withUpload(Upload|array $upload): self
    {
        $self = clone $this;
        $self['upload'] = $upload;

        return $self;
    }
}
