<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowRule;

/**
 * Event specifies when this rule starts. Use asset.ready for the single starting rule. Output ready events require an origin caption or static rendition action in this Workflow.
 */
enum Event: string
{
    case ASSET_READY = 'asset.ready';

    case ASSET_OUTPUT_READY = 'asset.output.ready';
}
