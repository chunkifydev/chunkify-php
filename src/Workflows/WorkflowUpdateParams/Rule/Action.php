<?php

declare(strict_types=1);

namespace Chunkify\Workflows\WorkflowUpdateParams\Rule;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;
use Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowCaptionActionParams;
use Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowStaticActionParams;
use Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowThumbnailActionParams;
use Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowTranscriptActionParams;
use Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowTranslationActionParams;

/**
 * One action to perform when a rule matches. The type determines the required parameters.
 *
 * @phpstan-import-type WorkflowStaticActionParamsShape from \Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowStaticActionParams
 * @phpstan-import-type WorkflowCaptionActionParamsShape from \Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowCaptionActionParams
 * @phpstan-import-type WorkflowTranslationActionParamsShape from \Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowTranslationActionParams
 * @phpstan-import-type WorkflowThumbnailActionParamsShape from \Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowThumbnailActionParams
 * @phpstan-import-type WorkflowTranscriptActionParamsShape from \Chunkify\Workflows\WorkflowUpdateParams\Rule\Action\WorkflowTranscriptActionParams
 *
 * @phpstan-type ActionVariants = WorkflowStaticActionParams|WorkflowCaptionActionParams|WorkflowTranslationActionParams|WorkflowThumbnailActionParams|WorkflowTranscriptActionParams
 * @phpstan-type ActionShape = ActionVariants|WorkflowStaticActionParamsShape|WorkflowCaptionActionParamsShape|WorkflowTranslationActionParamsShape|WorkflowThumbnailActionParamsShape|WorkflowTranscriptActionParamsShape
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
            'create_static_rendition' => WorkflowStaticActionParams::class,
            'create_caption' => WorkflowCaptionActionParams::class,
            'translate_caption' => WorkflowTranslationActionParams::class,
            'create_thumbnails' => WorkflowThumbnailActionParams::class,
            'create_transcript' => WorkflowTranscriptActionParams::class,
        ];
    }
}
