<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowUpdateParams;

/**
 * SchemaVersion specifies the Workflow definition format. The supported version is 1. Required when rules is provided.
 */
enum SchemaVersion: int
{
    case _1 = 1;
}
