<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

enum WorkflowRuleEvent: string
{
    case ASSET_READY = 'asset.ready';

    case ASSET_OUTPUT_READY = 'asset.output.ready';
}
