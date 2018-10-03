<?php

declare(strict_types=1);

namespace Phrench\Conjugator\SecondGroup;

use Phrench\ConjugatorInterface;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

class Present implements ConjugatorInterface
{
    public function conjugate(Verb $verb, ConjugationModality $modality): string
    {
        switch ($modality->getPerson()) {
            case ConjugationModality::PERSON_FIRST_SINGULAR:
                return $this->append($verb, 'is');
            case ConjugationModality::PERSON_SECOND_SINGULAR:
                return $this->append($verb, 'is');
            case ConjugationModality::PERSON_THIRD_SINGULAR:
                return $this->append($verb, 'it');
            case ConjugationModality::PERSON_FIRST_PLURAL:
                return $this->append($verb, 'issons');
            case ConjugationModality::PERSON_SECOND_PLURAL:
                return $this->append($verb, 'issez');
            case ConjugationModality::PERSON_THIRD_PLURAL:
                return $this->append($verb, 'issent');
        }
    }

    public function supports(Verb $verb, ConjugationModality $modality): bool
    {
        return $modality->getTense() === ConjugationModality::TENSE_PRESENT;
    }

    private function append(Verb $verb, string $suffix): string
    {
        return sprintf('%s%s', $verb->getStem(), $suffix);
    }
}
