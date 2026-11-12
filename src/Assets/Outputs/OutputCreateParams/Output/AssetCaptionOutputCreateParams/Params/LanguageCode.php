<?php

declare(strict_types=1);

namespace Chunkify\Assets\Outputs\OutputCreateParams\Output\AssetCaptionOutputCreateParams\Params;

/**
 * LanguageCode specifies the target language for a translated caption. Supply source_caption_id with this field. Omit both fields to transcribe the Asset audio with automatic language detection.
 */
enum LanguageCode: string
{
    case EN = 'en';

    case FR = 'fr';

    case ES = 'es';

    case DE = 'de';

    case IT = 'it';

    case PT = 'pt';

    case NL = 'nl';

    case JA = 'ja';

    case KO = 'ko';

    case ZH = 'zh';

    case AR = 'ar';

    case HI = 'hi';

    case RU = 'ru';

    case TR = 'tr';

    case PL = 'pl';

    case SV = 'sv';
}
