<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowCreateParams;

/**
 * SchemaVersion specifies the Workflow definition format. The supported version is 1.
 */
enum SchemaVersion: int
{
    case _1 = 1;
}
