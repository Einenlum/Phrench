<?php

declare(strict_types=1);

namespace Phrench\Conjugator\FirstGroup;

use Phrench\ConjugatorInterface;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

class Present implements ConjugatorInterface
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

        throw new \Exception('No conjugator can conjugate this verb');
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
