<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;

/**
 * Webhook notification. The event field selects the shape of data.
 *
 * @phpstan-import-type NotificationPayloadJobCompletedShape from \Chunkify\Webhooks\NotificationPayloadJobCompleted
 * @phpstan-import-type NotificationPayloadJobFailedShape from \Chunkify\Webhooks\NotificationPayloadJobFailed
 * @phpstan-import-type NotificationPayloadJobCreatedShape from \Chunkify\Webhooks\NotificationPayloadJobCreated
 * @phpstan-import-type NotificationPayloadSourceCreatedShape from \Chunkify\Webhooks\NotificationPayloadSourceCreated
 * @phpstan-import-type NotificationPayloadSourceDeletedShape from \Chunkify\Webhooks\NotificationPayloadSourceDeleted
 * @phpstan-import-type NotificationPayloadUploadCreatedShape from \Chunkify\Webhooks\NotificationPayloadUploadCreated
 * @phpstan-import-type NotificationPayloadUploadCompletedShape from \Chunkify\Webhooks\NotificationPayloadUploadCompleted
 * @phpstan-import-type NotificationPayloadUploadFailedShape from \Chunkify\Webhooks\NotificationPayloadUploadFailed
 * @phpstan-import-type NotificationPayloadAssetShape from \Chunkify\Webhooks\NotificationPayloadAsset
 * @phpstan-import-type NotificationPayloadAssetOutputShape from \Chunkify\Webhooks\NotificationPayloadAssetOutput
 * @phpstan-import-type NotificationPayloadAssetOutputDeletedShape from \Chunkify\Webhooks\NotificationPayloadAssetOutputDeleted
 * @phpstan-import-type NotificationPayloadAssetDeletedShape from \Chunkify\Webhooks\NotificationPayloadAssetDeleted
 * @phpstan-import-type NotificationPayloadWorkflowRunShape from \Chunkify\Webhooks\NotificationPayloadWorkflowRun
 * @phpstan-import-type NotificationPayloadTranscodingShape from \Chunkify\Webhooks\NotificationPayloadTranscoding
 * @phpstan-import-type NotificationPayloadThumbnailShape from \Chunkify\Webhooks\NotificationPayloadThumbnail
 *
 * @phpstan-type UnwrapWebhookEventVariants = NotificationPayloadJobCompleted|NotificationPayloadJobFailed|NotificationPayloadJobCreated|NotificationPayloadSourceCreated|NotificationPayloadSourceDeleted|NotificationPayloadUploadCreated|NotificationPayloadUploadCompleted|NotificationPayloadUploadFailed|NotificationPayloadAsset|NotificationPayloadAssetOutput|NotificationPayloadAssetOutputDeleted|NotificationPayloadAssetDeleted|NotificationPayloadWorkflowRun|NotificationPayloadTranscoding|NotificationPayloadThumbnail
 * @phpstan-type UnwrapWebhookEventShape = UnwrapWebhookEventVariants|NotificationPayloadJobCompletedShape|NotificationPayloadJobFailedShape|NotificationPayloadJobCreatedShape|NotificationPayloadSourceCreatedShape|NotificationPayloadSourceDeletedShape|NotificationPayloadUploadCreatedShape|NotificationPayloadUploadCompletedShape|NotificationPayloadUploadFailedShape|NotificationPayloadAssetShape|NotificationPayloadAssetOutputShape|NotificationPayloadAssetOutputDeletedShape|NotificationPayloadAssetDeletedShape|NotificationPayloadWorkflowRunShape|NotificationPayloadTranscodingShape|NotificationPayloadThumbnailShape
 */
final class UnwrapWebhookEvent implements ConverterSource
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
            'job.completed' => NotificationPayloadJobCompleted::class,
            'job.failed' => NotificationPayloadJobFailed::class,
            'job.cancelled' => NotificationPayloadJobFailed::class,
            'job.created' => NotificationPayloadJobCreated::class,
            'source.created' => NotificationPayloadSourceCreated::class,
            'source.deleted' => NotificationPayloadSourceDeleted::class,
            'upload.created' => NotificationPayloadUploadCreated::class,
            'upload.completed' => NotificationPayloadUploadCompleted::class,
            'upload.failed' => NotificationPayloadUploadFailed::class,
            'upload.expired' => NotificationPayloadUploadFailed::class,
            'asset.created' => NotificationPayloadAsset::class,
            'asset.ready' => NotificationPayloadAsset::class,
            'asset.playback_ready' => NotificationPayloadAsset::class,
            'asset.failed' => NotificationPayloadAsset::class,
            'asset.expired' => NotificationPayloadAsset::class,
            'asset.output.created' => NotificationPayloadAssetOutput::class,
            'asset.output.ready' => NotificationPayloadAssetOutput::class,
            'asset.output.failed' => NotificationPayloadAssetOutput::class,
            'asset.output.deleted' => NotificationPayloadAssetOutputDeleted::class,
            'asset.deleted' => NotificationPayloadAssetDeleted::class,
            'workflow_run.created' => NotificationPayloadWorkflowRun::class,
            'workflow_run.completed' => NotificationPayloadWorkflowRun::class,
            'workflow_run.failed' => NotificationPayloadWorkflowRun::class,
            'workflow_run.cancelled' => NotificationPayloadWorkflowRun::class,
            'transcoding.created' => NotificationPayloadTranscoding::class,
            'transcoding.ready' => NotificationPayloadTranscoding::class,
            'transcoding.failed' => NotificationPayloadTranscoding::class,
            'transcoding.cancelled' => NotificationPayloadTranscoding::class,
            'transcoding.expired' => NotificationPayloadTranscoding::class,
            'transcoding.deleted' => NotificationPayloadTranscoding::class,
            'thumbnail.created' => NotificationPayloadThumbnail::class,
            'thumbnail.ready' => NotificationPayloadThumbnail::class,
            'thumbnail.failed' => NotificationPayloadThumbnail::class,
            'thumbnail.expired' => NotificationPayloadThumbnail::class,
            'thumbnail.deleted' => NotificationPayloadThumbnail::class,
        ];
    }
}
