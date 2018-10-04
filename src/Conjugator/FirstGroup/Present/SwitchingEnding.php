<?php

declare(strict_types=1);

namespace Phrench\Conjugator\FirstGroup\Present;

use Phrench\ConjugatorInterface;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

class SwitchingEnding implements ConjugatorInterface
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
                return $this->append($verb, 'ons', true);
            case ConjugationModality::PERSON_SECOND_PLURAL:
                return $this->append($verb, 'ez');
            case ConjugationModality::PERSON_THIRD_PLURAL:
                return $this->append($verb, 'ent');
        }
    }

    public function supports(Verb $verb, ConjugationModality $modality): bool
    {
        return $modality->getTense() === ConjugationModality::TENSE_PRESENT
            && $this->isEndingDangerous($verb->getStem())
        ;
    }

    private function append(Verb $verb, string $suffix, bool $replaceDangerousEnding = false): string
    {
        if (!$replaceDangerousEnding) {
            return $verb->getStem().$suffix;
        }

        $removeLastEvilLetter = function (string $stem) {
            return substr($stem, 0, strlen($stem) - 1);
        };
        $getFunnyReplacement = function (string $stem) {
            return Verb::DANGEROUS_ENDING_CONSONANTS[substr($stem, -1)];
        };

        $newStem = $removeLastEvilLetter($verb->getStem()).$getFunnyReplacement($verb->getStem());

        return $newStem.$suffix;
    }

    private function isEndingDangerous(string $stem): bool
    {
        $lastLetter = substr($stem, -1);

        return in_array(
            $lastLetter,
            array_keys(Verb::DANGEROUS_ENDING_CONSONANTS)
        );
    }
}
