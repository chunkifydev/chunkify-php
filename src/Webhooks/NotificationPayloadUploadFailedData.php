<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Uploads\Upload;

/**
 * Payload data structure for upload.failed and upload.expired events.
 *
 * @phpstan-import-type UploadShape from \Chunkify\Uploads\Upload
 *
 * @phpstan-type NotificationPayloadUploadFailedDataShape = array{
 *   upload: Upload|UploadShape
 * }
 */
final class NotificationPayloadUploadFailedData implements BaseModel
{
    /** @use SdkModel<NotificationPayloadUploadFailedDataShape> */
    use SdkModel;

    #[Required]
    public Upload $upload;

    /**
     * `new NotificationPayloadUploadFailedData()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadUploadFailedData::with(upload: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadUploadFailedData)->withUpload(...)
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
     * @param Upload|UploadShape $upload
     */
    public static function with(Upload|array $upload): self
    {
        $self = new self;

        $self['upload'] = $upload;

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
