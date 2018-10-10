<?php

declare(strict_types=1);

namespace Phrench\PhoneticFormatter;

use PHLAK\Twine\Str;
use Phrench\PhoneticFormatterInterface;

/**
 * Some verbs with a stem ending by "c" show a problem with
 * the first person of plural. "Nous lancons" changes the sound (k instead of s).
 * Therefore we need to change "c" by "ç".
 * "Nous lancons" becomes "Nous lançons", but "vous lancez" stay the same.
 */
class CIsDangerous implements PhoneticFormatterInterface
{
    public function fix(string $conjugationToFix): string
    {
        $lastCPosition = strrpos($conjugationToFix, 'c');

        if (!$this->oIsFollowingLastC($conjugationToFix, $lastCPosition)) {
            return $conjugationToFix;
        }

        $fixed = sprintf(
            '%sç%s',
            substr($conjugationToFix, 0, $lastCPosition),
            substr($conjugationToFix, $lastCPosition + 1)
        );

        return $fixed;
    }

    public function supports(string $infinitive): bool
    {
        $str = new Str($infinitive);

        return $str->endsWith('cer');
    }

    private function oIsFollowingLastC(string $conjugationToFix, int $lastCPosition): bool
    {
        return 'o' === $conjugationToFix[$lastCPosition + 1];
    }
}
