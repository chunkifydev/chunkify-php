<?php

declare(strict_types=1);

namespace Chunkify\Notifications\Notification;

/**
 * Type of event that triggered this notification.
 */
enum Event: string
{
    case JOB_CREATED = 'job.created';

    case JOB_COMPLETED = 'job.completed';

    case JOB_FAILED = 'job.failed';

    case JOB_CANCELLED = 'job.cancelled';

    case SOURCE_CREATED = 'source.created';

    case SOURCE_DELETED = 'source.deleted';

    case UPLOAD_CREATED = 'upload.created';

    case UPLOAD_COMPLETED = 'upload.completed';

    case UPLOAD_FAILED = 'upload.failed';

    case UPLOAD_EXPIRED = 'upload.expired';

    case ASSET_CREATED = 'asset.created';

    case ASSET_READY = 'asset.ready';

    case ASSET_PLAYBACK_READY = 'asset.playback_ready';

    case ASSET_FAILED = 'asset.failed';

    case ASSET_EXPIRED = 'asset.expired';

    case ASSET_DELETED = 'asset.deleted';

    case ASSET_OUTPUT_CREATED = 'asset.output.created';

    case ASSET_OUTPUT_READY = 'asset.output.ready';

    case ASSET_OUTPUT_FAILED = 'asset.output.failed';

    case ASSET_OUTPUT_DELETED = 'asset.output.deleted';

    case WORKFLOW_RUN_CREATED = 'workflow_run.created';

    case WORKFLOW_RUN_COMPLETED = 'workflow_run.completed';

    case WORKFLOW_RUN_FAILED = 'workflow_run.failed';

    case WORKFLOW_RUN_CANCELLED = 'workflow_run.cancelled';

    case TRANSCODING_CREATED = 'transcoding.created';

    case TRANSCODING_READY = 'transcoding.ready';

    case TRANSCODING_FAILED = 'transcoding.failed';

    case TRANSCODING_CANCELLED = 'transcoding.cancelled';

    case TRANSCODING_EXPIRED = 'transcoding.expired';

    case TRANSCODING_DELETED = 'transcoding.deleted';

    case THUMBNAIL_CREATED = 'thumbnail.created';

    case THUMBNAIL_READY = 'thumbnail.ready';

    case THUMBNAIL_FAILED = 'thumbnail.failed';

    case THUMBNAIL_EXPIRED = 'thumbnail.expired';

    case THUMBNAIL_DELETED = 'thumbnail.deleted';
}
