<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\Data;

use Chunkify\Core\Attributes\Required;
use Chunkify\Core\Concerns\SdkModel;
use Chunkify\Core\Contracts\BaseModel;
use Chunkify\Uploads\Upload;

/**
 * Payload for upload.created. A waiting upload session has been created; its Source is created only after successful completion. Transfer credentials are not included.
 *
 * @phpstan-import-type UploadShape from \Chunkify\Uploads\Upload
 *
 * @phpstan-type NotificationPayloadUploadCreatedShape = array{
 *   upload: Upload|UploadShape
 * }
 */
final class NotificationPayloadUploadCreated implements BaseModel
{
    /** @use SdkModel<NotificationPayloadUploadCreatedShape> */
    use SdkModel;

    #[Required]
    public Upload $upload;

    /**
     * `new NotificationPayloadUploadCreated()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationPayloadUploadCreated::with(upload: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationPayloadUploadCreated)->withUpload(...)
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
