<?php

declare(strict_types=1);

namespace Phrench\Conjugator;

use Phrench\ConjugatorInterface;
use Phrench\Conjugator\FirstGroup;
use Phrench\Conjugator\SecondGroup;
use Phrench\Conjugator;

abstract class Factory
{
    public static function build(): ConjugatorInterface
    {
        $firstGroupPresent = new FirstGroup\Present([
            new FirstGroup\Present\AccentuationIsComing(),
            new FirstGroup\Present\DoubleConsonantsAppear(),
            new FirstGroup\Present\SwitchingEnding(),
            new FirstGroup\Present\Standard(),
        ]);
        $firstGroup = new FirstGroup([$firstGroupPresent]);
        $secondGroup = new SecondGroup([new SecondGroup\Present()]);

        return new Conjugator([$firstGroup, $secondGroup]);
    }
}
