<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

enum WorkflowOutputBindingFrom: string
{
    case EVENT_OUTPUT_ID = 'event.output.id';
}
