<?php

declare(strict_types=1);

namespace Chunkify\Projects\AnalyticsConnections\Keys\AnalyticsKey;

/**
 * Purpose distinguishes player ingestion, read-only API access and a separate read-only MCP credential. Read and MCP keys have the same collector permissions.
 */
enum Purpose: string
{
    case PLAYER = 'player';

    case READ = 'read';

    case MCP = 'mcp';
}
