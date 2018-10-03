<?php

declare(strict_types=1);

namespace Phrench\Conjugator;

use Phrench\ConjugatorInterface;
use Phrench\Conjugator\FirstGroup;
use Phrench\Conjugator\FirstGroup\Present;
use Phrench\Conjugator;

abstract class Factory
{
    public static function build(): ConjugatorInterface
    {
        $firstGroup = new FirstGroup([new Present()]);

        return new Conjugator([$firstGroup]);
    }
}
