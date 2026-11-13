<?php

declare(strict_types=1);

namespace Chunkify\Workflows;

use Chunkify\Core\Concerns\SdkUnion;
use Chunkify\Core\Conversion\Contracts\Converter;
use Chunkify\Core\Conversion\Contracts\ConverterSource;

/**
 * One action to perform when a rule matches. The type determines the required parameters.
 *
 * @phpstan-import-type WorkflowStaticActionParamsShape from \Chunkify\Workflows\WorkflowStaticActionParams
 * @phpstan-import-type WorkflowCaptionActionParamsShape from \Chunkify\Workflows\WorkflowCaptionActionParams
 * @phpstan-import-type WorkflowTranslationActionParamsShape from \Chunkify\Workflows\WorkflowTranslationActionParams
 * @phpstan-import-type WorkflowThumbnailActionParamsShape from \Chunkify\Workflows\WorkflowThumbnailActionParams
 * @phpstan-import-type WorkflowTranscriptActionParamsShape from \Chunkify\Workflows\WorkflowTranscriptActionParams
 *
 * @phpstan-type WorkflowActionParamsVariants = WorkflowStaticActionParams|WorkflowCaptionActionParams|WorkflowTranslationActionParams|WorkflowThumbnailActionParams|WorkflowTranscriptActionParams
 * @phpstan-type WorkflowActionParamsShape = WorkflowActionParamsVariants|WorkflowStaticActionParamsShape|WorkflowCaptionActionParamsShape|WorkflowTranslationActionParamsShape|WorkflowThumbnailActionParamsShape|WorkflowTranscriptActionParamsShape
 */
final class WorkflowActionParams implements ConverterSource
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
