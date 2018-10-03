<?php

declare(strict_types=1);

namespace Phrench;

use Phrench\DTO\Verb;
use Phrench\DTO\ConjugationModality;

class Conjugator implements ConjugatorInterface
{
    private $conjugators;

    public function __construct(array $conjugators)
    {
        $this->conjugators = $conjugators;
    }

    public function conjugate(Verb $verb, ConjugationModality $modality): string
    {
        foreach ($this->conjugators as $conjugator) {
            if ($conjugator->supports($verb, $modality)) {
                return $conjugator->conjugate($verb, $modality);
            }
        }

        throw new \RuntimeException('No conjugator can conjugate this');
    }

    public function supports(Verb $verb, ConjugationModality $modality): bool
    {
        foreach ($this->conjugators as $conjugator) {
            if ($conjugator->supports($verb, $modality)) {
                return true;
            }
        }

        return false;
    }
}
