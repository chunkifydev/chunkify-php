<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowCreateParams\Rule;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowCaptionAction;
use Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowStaticAction;
use Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowThumbnailAction;
use Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowTranscriptAction;
use Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowTranslationAction;

/**
 * One action to perform when a rule matches. The type determines the required parameters.
 *
 * @phpstan-import-type WorkflowStaticActionShape from \Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowStaticAction
 * @phpstan-import-type WorkflowCaptionActionShape from \Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowCaptionAction
 * @phpstan-import-type WorkflowTranslationActionShape from \Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowTranslationAction
 * @phpstan-import-type WorkflowThumbnailActionShape from \Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowThumbnailAction
 * @phpstan-import-type WorkflowTranscriptActionShape from \Chunkify\Workflows\WorkflowCreateParams\Rule\Action\WorkflowTranscriptAction
 *
 * @phpstan-type ActionVariants = WorkflowStaticAction|WorkflowCaptionAction|WorkflowTranslationAction|WorkflowThumbnailAction|WorkflowTranscriptAction
 * @phpstan-type ActionShape = ActionVariants|WorkflowStaticActionShape|WorkflowCaptionActionShape|WorkflowTranslationActionShape|WorkflowThumbnailActionShape|WorkflowTranscriptActionShape
 */
final class Action implements ConverterSource
{
    use SdkUnion;

    public static function discriminator(): string
    {
        return 'type';
    }

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'create_static_rendition' => WorkflowStaticAction::class,
            'create_caption' => WorkflowCaptionAction::class,
            'translate_caption' => WorkflowTranslationAction::class,
            'create_thumbnails' => WorkflowThumbnailAction::class,
            'create_transcript' => WorkflowTranscriptAction::class,
        ];
    }
}
