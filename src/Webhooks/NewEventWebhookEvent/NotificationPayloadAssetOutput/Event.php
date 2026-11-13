<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAssetOutput;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case ASSET_OUTPUT_CREATED = 'asset.output.created';

    case ASSET_OUTPUT_READY = 'asset.output.ready';

    case ASSET_OUTPUT_FAILED = 'asset.output.failed';
}
