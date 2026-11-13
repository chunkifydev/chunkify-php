<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAsset;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetDeleted;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetOutput;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetOutputDeleted;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadJobCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadJobFailed;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadSourceCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadSourceDeleted;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadThumbnail;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadTranscoding;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadCreated;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadWorkflowRun;

/**
 * Webhook notification. The event field selects the shape of data.
 *
 * @phpstan-import-type NotificationPayloadJobCompletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadJobCompleted
 * @phpstan-import-type NotificationPayloadJobFailedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadJobFailed
 * @phpstan-import-type NotificationPayloadJobCreatedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadJobCreated
 * @phpstan-import-type NotificationPayloadSourceCreatedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadSourceCreated
 * @phpstan-import-type NotificationPayloadSourceDeletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadSourceDeleted
 * @phpstan-import-type NotificationPayloadUploadCreatedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadCreated
 * @phpstan-import-type NotificationPayloadUploadCompletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadCompleted
 * @phpstan-import-type NotificationPayloadUploadFailedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadUploadFailed
 * @phpstan-import-type NotificationPayloadAssetShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAsset
 * @phpstan-import-type NotificationPayloadAssetOutputShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetOutput
 * @phpstan-import-type NotificationPayloadAssetOutputDeletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetOutputDeleted
 * @phpstan-import-type NotificationPayloadAssetDeletedShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetDeleted
 * @phpstan-import-type NotificationPayloadWorkflowRunShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadWorkflowRun
 * @phpstan-import-type NotificationPayloadTranscodingShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadTranscoding
 * @phpstan-import-type NotificationPayloadThumbnailShape from \Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadThumbnail
 *
 * @phpstan-type NewEventWebhookEventVariants = NotificationPayloadJobCompleted|NotificationPayloadJobFailed|NotificationPayloadJobCreated|NotificationPayloadSourceCreated|NotificationPayloadSourceDeleted|NotificationPayloadUploadCreated|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed|NotificationPayloadAsset|NotificationPayloadAssetOutput|NotificationPayloadAssetOutputDeleted|NotificationPayloadAssetDeleted|NotificationPayloadWorkflowRun|NotificationPayloadTranscoding|NotificationPayloadThumbnail
 * @phpstan-type NewEventWebhookEventShape = NewEventWebhookEventVariants|NotificationPayloadJobCompletedShape|NotificationPayloadJobFailedShape|NotificationPayloadJobCreatedShape|NotificationPayloadSourceCreatedShape|NotificationPayloadSourceDeletedShape|NotificationPayloadUploadCreatedShape|NotificationPayloadUploadCompletedShape|NotificationPayloadUploadFailedShape|NotificationPayloadAssetShape|NotificationPayloadAssetOutputShape|NotificationPayloadAssetOutputDeletedShape|NotificationPayloadAssetDeletedShape|NotificationPayloadWorkflowRunShape|NotificationPayloadTranscodingShape|NotificationPayloadThumbnailShape
 */
final class NewEventWebhookEvent implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'event';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            NotificationPayloadJobFailed::class,
            NotificationPayloadUploadFailed::class,
            NotificationPayloadAsset::class,
            NotificationPayloadAssetOutput::class,
            NotificationPayloadWorkflowRun::class,
            NotificationPayloadTranscoding::class,
            NotificationPayloadThumbnail::class,
            'job.completed' => NotificationPayloadJobCompleted::class,
            'job.created' => NotificationPayloadJobCreated::class,
            'source.created' => NotificationPayloadSourceCreated::class,
            'source.deleted' => NotificationPayloadSourceDeleted::class,
            'upload.created' => NotificationPayloadUploadCreated::class,
            'upload.completed' => NotificationPayloadUploadCompleted::class,
            'asset.output.deleted' => NotificationPayloadAssetOutputDeleted::class,
            'asset.deleted' => NotificationPayloadAssetDeleted::class,
        ];
    }
}
