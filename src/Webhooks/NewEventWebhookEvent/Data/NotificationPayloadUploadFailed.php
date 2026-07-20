<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\Data;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Uploads\Upload;

/**
 * Payload data structure for upload.failed and upload.expired events.
 *
 * @phpstan-import-type UploadShape from \Chunkify\Uploads\Upload
 *
 * @phpstan-type NotificationPayloadUploadFailedShape = array{
 *   upload: Upload|UploadShape
 * }
 */
final class NotificationPayloadUploadFailed implements BaseModel
{
    /** @use SdkModel<NotificationPayloadUploadFailedShape> */
    use SdkModel;

    #[Required]
    public Upload $upload;

    /**
     * `new NotificationPayloadUploadFailed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadUploadFailed::with(upload: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadUploadFailed)->withUpload(...)
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
