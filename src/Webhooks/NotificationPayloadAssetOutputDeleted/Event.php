<?php

declare(strict_types=1);

namespace Chunkify\Webhooks\NotificationPayloadAssetOutputDeleted;

/**
 * Type of event that triggered the notification.
 */
enum Event: string
{
    case ASSET_OUTPUT_DELETED = 'asset.output.deleted';
}
