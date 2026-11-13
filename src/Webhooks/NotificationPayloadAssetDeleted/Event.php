<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadAssetDeleted;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case ASSET_DELETED = 'asset.deleted';
}
