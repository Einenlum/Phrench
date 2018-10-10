<?php

declare(strict_types=1);

namespace Phrench\Conjugator\FirstGroup\Present;

use Phrench\ConjugatorInterface;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

class DoubleConsonantsAppear implements ConjugatorInterface
{
    public function conjugate(Verb $verb, ConjugationModality $modality): string
    {
        switch ($modality->getPerson()) {
            case ConjugationModality::PERSON_FIRST_SINGULAR:
                return $this->append($verb, 'e', true);
            case ConjugationModality::PERSON_SECOND_SINGULAR:
                return $this->append($verb, 'es', true);
            case ConjugationModality::PERSON_THIRD_SINGULAR:
                return $this->append($verb, 'e', true);
            case ConjugationModality::PERSON_FIRST_PLURAL:
                return $this->append($verb, 'ons');
            case ConjugationModality::PERSON_SECOND_PLURAL:
                return $this->append($verb, 'ez');
            case ConjugationModality::PERSON_THIRD_PLURAL:
                return $this->append($verb, 'ent', true);
        }
    }

    public function supports(Verb $verb, ConjugationModality $modality): bool
    {
        return $modality->getTense() === ConjugationModality::TENSE_PRESENT
            && in_array($verb->getInfinitive(), Verb::DOUBLE_CONSONANTS_APPEAR)
        ;
    }

    private function append(Verb $verb, string $suffix, bool $doubleConsonants = false): string
    {
        $stem = $verb->getStem();
        if (!$doubleConsonants) {
            return $stem.$suffix;
        }

        $getLastLetter = function(string $stem) {
            return substr($stem, -1);
        };

        $lastLetter = $getLastLetter($stem);
        $stem = sprintf('%s%s', $stem, $lastLetter);

        return sprintf('%s%s', $stem, $suffix);
    }

    private function isEndingDangerous(string $stem): bool
    {
        $lastLetter = substr($stem, -1);

        return in_array(
            $lastLetter,
            array_keys(self::DANGEROUS_ENDING_CONSONANTS)
        );
    }
}
