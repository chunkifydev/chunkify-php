<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\UnwrapWebhookEvent;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAsset;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAssetDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAssetOutput;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAssetOutputDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadSourceCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadTranscoding;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadWorkflowRun;
use Chunkify\Webhooks\UnwrapWebhookEvent\Data\ThumbnailEventData;

/**
 * Payload for the event named in event. Replays preserve the original data; retrieve the resource for current state and fresh signed URLs.
 *
 * @phpstan-import-type NotificationPayloadJobCompletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobCompleted
 * @phpstan-import-type NotificationPayloadJobFailedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobFailed
 * @phpstan-import-type NotificationPayloadJobCreatedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadJobCreated
 * @phpstan-import-type NotificationPayloadSourceCreatedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadSourceCreated
 * @phpstan-import-type NotificationPayloadUploadCreatedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadCreated
 * @phpstan-import-type NotificationPayloadUploadCompletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadCompleted
 * @phpstan-import-type NotificationPayloadUploadFailedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadUploadFailed
 * @phpstan-import-type NotificationPayloadAssetShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAsset
 * @phpstan-import-type NotificationPayloadAssetOutputShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAssetOutput
 * @phpstan-import-type NotificationPayloadAssetOutputDeletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAssetOutputDeleted
 * @phpstan-import-type NotificationPayloadAssetDeletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadAssetDeleted
 * @phpstan-import-type NotificationPayloadWorkflowRunShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadWorkflowRun
 * @phpstan-import-type NotificationPayloadTranscodingShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\NotificationPayloadTranscoding
 * @phpstan-import-type ThumbnailEventDataShape from \Chunkify\Webhooks\UnwrapWebhookEvent\Data\ThumbnailEventData
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
