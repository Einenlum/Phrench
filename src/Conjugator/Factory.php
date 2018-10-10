<?php

declare(strict_types=1);

namespace Phrench\Conjugator;

use Phrench\ConjugatorInterface;
use Phrench\Conjugator\FirstGroup;
use Phrench\Conjugator\SecondGroup;
use Phrench\Conjugator;
use Phrench\PhoneticFormatter\CIsDangerous;
use Phrench\PhoneticFormatter\GIsDangerous;

abstract class Factory
{
    public static function build(): ConjugatorInterface
    {
        $firstGroupPresent = new FirstGroup\Present([
            new FirstGroup\Present\TrebleAccentuationIsChanging(),
            new FirstGroup\Present\BassAccentuationIsComing(),
            new FirstGroup\Present\DoubleConsonantsAppear(),
            new FirstGroup\Present\Standard(),
        ]);
        $firstGroup = new FirstGroup([$firstGroupPresent]);
        $secondGroup = new SecondGroup([new SecondGroup\Present()]);

        $phoneticFormatters = [
            new GIsDangerous(),
            new CIsDangerous()
        ];

        return new Conjugator([$firstGroup, $secondGroup], $phoneticFormatters);
    }
}
