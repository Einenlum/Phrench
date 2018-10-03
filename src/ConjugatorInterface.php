<?php

declare(strict_types=1);

namespace Phrench;

use Phrench\DTO\Verb;
use Phrench\DTO\ConjugationModality;

interface ConjugatorInterface
{
    public function conjugate(Verb $verb, ConjugationModality $modality): string;

    public function supports(Verb $verb, ConjugationModality $modality): bool;
}
