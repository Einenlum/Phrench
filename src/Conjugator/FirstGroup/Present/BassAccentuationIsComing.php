<?php

declare(strict_types=1);

namespace Phrench\Conjugator\FirstGroup\Present;

use Phrench\ConjugatorInterface;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

/**
 * In french "è" is called "accent grave", literally "bass accent",
 * on the contrary to "é" which is called "accent aigu", literally
 * "treble accent". I dunno. Don't ask me.
 */
class BassAccentuationIsComing implements ConjugatorInterface
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
            && $this->isStemCandidateToBassAccentuation($verb->getStem())
            && !in_array($verb->getInfinitive(), Verb::DOUBLE_CONSONANTS_APPEAR)
        ;
    }

    private function isStemCandidateToBassAccentuation(string $stem): bool
    {
        $candidateEndings = [
            'et',
            'el',
            'em',
            'en',
            'ec',
            'ed',
            'eg',
            'ep',
            'er',
            'es',
            'ev',
            'evr',
        ];

        foreach ($candidateEndings as $ending) {
            if ($this->endsBy($stem, $ending)) {
                return true;
            }
        }

        return false;
    }

    private function endsBy(string $haystack, string $needle): bool
    {
        return 0 === strpos(substr($haystack, -(strlen($needle))), $needle);
    }

    private function append(Verb $verb, string $suffix, bool $addAccent = false): string
    {
        $stem = $verb->getStem();
        if (!$addAccent) {
            return $stem.$suffix;
        }

        // replace last "e" by "è"
        // $stem[strlen($stem)-2] = 'è'; does not work…
        // Seems PHP is having as hard time as foreigners with french accents
        $lastLetter = substr($stem, -1);
        $stem = sprintf(
            '%sè%s',
            substr($stem, 0, (strlen($stem)-2)),
            $lastLetter
        );

        return $stem.$suffix;
    }

}
