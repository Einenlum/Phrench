<?php

declare(strict_types=1);

namespace Phrench\Conjugator\FirstGroup\Present;

use Phrench\ConjugatorInterface;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

/**
 * @TODO: appeler -> appelle, acheter -> achète
 */
class Standard implements ConjugatorInterface
{
    public function conjugate(Verb $verb, ConjugationModality $modality): string
    {
        switch ($modality->getPerson()) {
            case ConjugationModality::PERSON_FIRST_SINGULAR:
                return $this->append($verb, 'e');
            case ConjugationModality::PERSON_SECOND_SINGULAR:
                return $this->append($verb, 'es');
            case ConjugationModality::PERSON_THIRD_SINGULAR:
                return $this->append($verb, 'e');
            case ConjugationModality::PERSON_FIRST_PLURAL:
                return $this->append($verb, 'ons');
            case ConjugationModality::PERSON_SECOND_PLURAL:
                return $this->append($verb, 'ez');
            case ConjugationModality::PERSON_THIRD_PLURAL:
                return $this->append($verb, 'ent');
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
