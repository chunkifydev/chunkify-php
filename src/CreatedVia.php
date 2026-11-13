<?php

declare(strict_types=1);

namespace Chunkify;

/**
 * CreatedVia specifies how the resource was created: api for API requests, dashboard for the Chunkify dashboard, mcp for MCP clients, and workflow for Workflow actions.
 * Omitted when the creator is unknown.
 */
enum CreatedVia: string
{
    case API = 'api';

    case DASHBOARD = 'dashboard';

    case MCP = 'mcp';

    case WORKFLOW = 'workflow';
}
