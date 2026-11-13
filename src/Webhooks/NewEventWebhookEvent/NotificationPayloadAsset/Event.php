<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NewEventWebhookEvent\NotificationPayloadAsset;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case ASSET_CREATED = 'asset.created';

    case ASSET_READY = 'asset.ready';

    case ASSET_PLAYBACK_READY = 'asset.playback_ready';

    case ASSET_FAILED = 'asset.failed';

    case ASSET_EXPIRED = 'asset.expired';
}
