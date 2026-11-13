<?php

declare(strict_types=1);

namespace Chunkify\Webhooks;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAsset;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetOutput;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetOutputDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadSourceCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadSourceDeleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadThumbnail;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadTranscoding;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadCompleted;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadCreated;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadFailed;
use Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadWorkflowRun;

/**
 * Webhook notification. The event field selects the shape of data.
 *
 * @phpstan-import-type NotificationPayloadJobCompletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobCompleted
 * @phpstan-import-type NotificationPayloadJobFailedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobFailed
 * @phpstan-import-type NotificationPayloadJobCreatedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadJobCreated
 * @phpstan-import-type NotificationPayloadSourceCreatedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadSourceCreated
 * @phpstan-import-type NotificationPayloadSourceDeletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadSourceDeleted
 * @phpstan-import-type NotificationPayloadUploadCreatedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadCreated
 * @phpstan-import-type NotificationPayloadUploadCompletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadCompleted
 * @phpstan-import-type NotificationPayloadUploadFailedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadUploadFailed
 * @phpstan-import-type NotificationPayloadAssetShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAsset
 * @phpstan-import-type NotificationPayloadAssetOutputShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetOutput
 * @phpstan-import-type NotificationPayloadAssetOutputDeletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetOutputDeleted
 * @phpstan-import-type NotificationPayloadAssetDeletedShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadAssetDeleted
 * @phpstan-import-type NotificationPayloadWorkflowRunShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadWorkflowRun
 * @phpstan-import-type NotificationPayloadTranscodingShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadTranscoding
 * @phpstan-import-type NotificationPayloadThumbnailShape from \Chunkify\Webhooks\UnwrapWebhookEvent\NotificationPayloadThumbnail
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
