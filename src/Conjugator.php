<?php

declare(strict_types=1);

namespace Phrench;

use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

class Conjugator implements ConjugatorInterface
{
    private $conjugators;
    private $phoneticFormatters;

    public function __construct(array $conjugators, array $phoneticFormatters)
    {
        $this->conjugators = $conjugators;
        $this->phoneticFormatters = $phoneticFormatters;
    }

    public function conjugate(Verb $verb, ConjugationModality $modality): string
    {
        $conjugated = $this->doConjugate($verb, $modality);

        foreach ($this->phoneticFormatters as $formatter) {
            if ($formatter->supports($verb->getInfinitive())) {
                $conjugated = $formatter->fix($conjugated);
            }
        }

        return $conjugated;
    }

    private function doConjugate(Verb $verb, ConjugationModality $modality): string
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
