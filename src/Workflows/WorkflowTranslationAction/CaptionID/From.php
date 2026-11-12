<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowTranslationAction\CaptionID;

/**
 * From specifies where to read the input output ID. Use event.output.id to consume the output in the triggering asset.output.ready event.
 */
enum From: string
{
    case EVENT_OUTPUT_ID = 'event.output.id';
}
