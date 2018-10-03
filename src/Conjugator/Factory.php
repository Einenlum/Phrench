<?php

declare(strict_types=1);

namespace Phrench\Conjugator;

use Phrench\Conjugator;
use Phrench\Conjugator\FirstGroup\Present;
use Phrench\ConjugatorInterface;

abstract class Factory
{
    public static function build(): ConjugatorInterface
    {
        $firstGroup = new FirstGroup([new Present()]);

        return new Conjugator([$firstGroup]);
    }
}
