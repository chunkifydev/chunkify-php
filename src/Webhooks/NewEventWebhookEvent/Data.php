<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAsset;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetDeleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetOutput;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetOutputDeleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobFailed;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadSourceCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadTranscoding;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadWorkflowRun;
use Chunkify\Webhooks\NewEventWebhookEvent\Data\ThumbnailEventData;

/**
 * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
 *
 * @phpstan-import-type NotificationPayloadJobCompletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCompleted
 * @phpstan-import-type NotificationPayloadJobFailedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobFailed
 * @phpstan-import-type NotificationPayloadJobCreatedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadJobCreated
 * @phpstan-import-type NotificationPayloadSourceCreatedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadSourceCreated
 * @phpstan-import-type NotificationPayloadUploadCreatedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCreated
 * @phpstan-import-type NotificationPayloadUploadCompletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadCompleted
 * @phpstan-import-type NotificationPayloadUploadFailedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadUploadFailed
 * @phpstan-import-type NotificationPayloadAssetShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAsset
 * @phpstan-import-type NotificationPayloadAssetOutputShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetOutput
 * @phpstan-import-type NotificationPayloadAssetOutputDeletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetOutputDeleted
 * @phpstan-import-type NotificationPayloadAssetDeletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadAssetDeleted
 * @phpstan-import-type NotificationPayloadWorkflowRunShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadWorkflowRun
 * @phpstan-import-type NotificationPayloadTranscodingShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\NotificationPayloadTranscoding
 * @phpstan-import-type ThumbnailEventDataShape from \Chunkify\Webhooks\NewEventWebhookEvent\Data\ThumbnailEventData
 *
 * @phpstan-type DataVariants = NotificationPayloadJobCompleted|NotificationPayloadJobFailed|NotificationPayloadJobCreated|NotificationPayloadSourceCreated|NotificationPayloadUploadCreated|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed|NotificationPayloadAsset|NotificationPayloadAssetOutput|NotificationPayloadAssetOutputDeleted|NotificationPayloadAssetDeleted|NotificationPayloadWorkflowRun|NotificationPayloadTranscoding|ThumbnailEventData
 * @phpstan-type DataShape = DataVariants|NotificationPayloadJobCompletedShape|NotificationPayloadJobFailedShape|NotificationPayloadJobCreatedShape|NotificationPayloadSourceCreatedShape|NotificationPayloadUploadCreatedShape|NotificationPayloadUploadCompletedShape|NotificationPayloadUploadFailedShape|NotificationPayloadAssetShape|NotificationPayloadAssetOutputShape|NotificationPayloadAssetOutputDeletedShape|NotificationPayloadAssetDeletedShape|NotificationPayloadWorkflowRunShape|NotificationPayloadTranscodingShape|ThumbnailEventDataShape
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
            NotificationPayloadJobCreated::class,
            NotificationPayloadSourceCreated::class,
            NotificationPayloadUploadCreated::class,
            NotificationPayloadUploadCompleted::class,
            NotificationPayloadUploadFailed::class,
            NotificationPayloadAsset::class,
            NotificationPayloadAssetOutput::class,
            NotificationPayloadAssetOutputDeleted::class,
            NotificationPayloadAssetDeleted::class,
            NotificationPayloadWorkflowRun::class,
            NotificationPayloadTranscoding::class,
            ThumbnailEventData::class,
        ];
    }
}
