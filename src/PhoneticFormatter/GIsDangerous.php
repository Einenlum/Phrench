<?php

declare(strict_types=1);

namespace Phrench\PhoneticFormatter;

use PHLAK\Twine\Str;
use Phrench\PhoneticFormatterInterface;

/**
 * Some verbs with a stem ending by "g" show a problem with
 * the first person of plural. "Nous mangons" changes the sound.
 * Therefore we need to add a "e" letter after the "g".
 * "Nous mangons" becomes "Nous mangeons"
 */
class GIsDangerous implements PhoneticFormatterInterface
{
    public function fix(string $conjugationToFix): string
    {
        $lastGPosition = strrpos($conjugationToFix, 'g');

        if ($this->eIsFollowingLastG($conjugationToFix, $lastGPosition)) {
            return $conjugationToFix;
        }

        $fixed = sprintf(
            '%s%s%s',
            substr($conjugationToFix, 0, $lastGPosition + 1),
            'e',
            substr($conjugationToFix, $lastGPosition + 1)
        );

        return $fixed;
    }

    public function supports(string $infinitive): bool
    {
        $str = new Str($infinitive);

        return $str->endsWith('ger');
    }

    private function eIsFollowingLastG(string $conjugationToFix, int $lastGPosition): bool
    {
        return 'e' === $conjugationToFix[$lastGPosition + 1];
    }
}
