<?php

declare(strict_types=1);

namespace Chunkify\Uploads\UploadCreateParams;

/**
 * UploadMode specifies the transfer method. Defaults to auto. Auto chooses multipart above 100 MiB and single PUT at or below 100 MiB for every Storage provider. Multipart requires a provider that supports the required multipart operations and signed part URLs. Provider failures return an error without falling back to single PUT.
 */
enum UploadMode: string
{
    case SINGLE = 'single';

    case MULTIPART = 'multipart';

    case AUTO = 'auto';
}
