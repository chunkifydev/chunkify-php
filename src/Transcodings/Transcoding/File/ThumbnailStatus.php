<?php

declare(strict_types=1);

namespace Chunkify\Transcodings\Transcoding\File;

/**
 * ThumbnailStatus reports the optional dashboard preview result. Failure does not affect the media file. Omitted for audio-only files.
 */
enum ThumbnailStatus: string
{
    case READY = 'ready';

    case FAILED = 'failed';
}
