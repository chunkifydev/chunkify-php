<?php

declare(strict_types=1);

namespace Chunkify\Storages\StorageCreateParams\Storage\StorageAwsCreateParams;

/**
 * Region specifies the region of the storage provider.
 */
enum Region: string
{
    case US_EAST_1 = 'us-east-1';

    case US_EAST_2 = 'us-east-2';

    case US_CENTRAL_1 = 'us-central-1';

    case US_WEST_1 = 'us-west-1';

    case US_WEST_2 = 'us-west-2';

    case EU_WEST_1 = 'eu-west-1';

    case EU_WEST_2 = 'eu-west-2';

    case EU_WEST_3 = 'eu-west-3';

    case EU_CENTRAL_1 = 'eu-central-1';

    case EU_NORTH_1 = 'eu-north-1';

    case AP_EAST_1 = 'ap-east-1';

    case AP_EAST_2 = 'ap-east-2';

    case AP_NORTHEAST_1 = 'ap-northeast-1';

    case AP_NORTHEAST_2 = 'ap-northeast-2';

    case AP_SOUTH_1 = 'ap-south-1';

    case AP_SOUTHEAST_1 = 'ap-southeast-1';

    case AP_SOUTHEAST_2 = 'ap-southeast-2';
}
