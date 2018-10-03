<?php

declare(strict_types=1);

namespace Phrench;

use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

interface ConjugatorInterface
{
    public function conjugate(Verb $verb, ConjugationModality $modality): string;

    public function supports(Verb $verb, ConjugationModality $modality): bool;
}
