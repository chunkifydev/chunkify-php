<?php

declare(strict_types=1);

namespace Chunkify\Notifications\NotificationListParams;

enum Event: string
{
    case JOB_COMPLETED = 'job.completed';

    case JOB_FAILED = 'job.failed';

    case JOB_CANCELLED = 'job.cancelled';

    case UPLOAD_COMPLETED = 'upload.completed';

    case UPLOAD_FAILED = 'upload.failed';

    case UPLOAD_EXPIRED = 'upload.expired';
}
