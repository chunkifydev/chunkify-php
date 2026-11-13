<?php

declare(strict_types=1);

namespace Chunkify\Assets\Workflow\Actions\AssetActionRun\Input;

/**
 * LanguageCode specifies the target language for the translated subtitle track, such as en or fr. The same code appears in the caption and HLS manifest.
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
