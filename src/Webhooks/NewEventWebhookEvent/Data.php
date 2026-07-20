<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobFailed;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadFailed;

/**
 * Event-specific payload data.
 *
 * @phpstan-import-type NotificationPayloadJobCompletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCompleted
 * @phpstan-import-type NotificationPayloadJobFailedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobFailed
 * @phpstan-import-type NotificationPayloadUploadCompletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCompleted
 * @phpstan-import-type NotificationPayloadUploadFailedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadFailed
 *
 * @phpstan-type DataVariants = NotificationPayloadJobCompleted|NotificationPayloadJobFailed|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed
 * @phpstan-type DataShape = DataVariants|NotificationPayloadJobCompletedShape|NotificationPayloadJobFailedShape|NotificationPayloadUploadCompletedShape|NotificationPayloadUploadFailedShape
 */
final class Data implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            NotificationPayloadJobCompleted::class,
            NotificationPayloadJobFailed::class,
            NotificationPayloadUploadCompleted::class,
            NotificationPayloadUploadFailed::class,
        ];
    }
}
