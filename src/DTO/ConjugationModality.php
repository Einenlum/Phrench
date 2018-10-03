<?php

declare(strict_types=1);

namespace Phrench\DTO;

class ConjugationModality
{
    const PERSON_FIRST_SINGULAR = 'first.singular';
    const PERSON_SECOND_SINGULAR = 'second.singular';
    const PERSON_THIRD_SINGULAR = 'third.singular';
    const PERSON_FIRST_PLURAL = 'first.plural';
    const PERSON_SECOND_PLURAL = 'second.plural';
    const PERSON_THIRD_PLURAL = 'third.plural';

    const MODE_INDICATIVE = 'indicative';

    const TENSE_PRESENT = 'present';

    private $person;
    private $tense;
    private $mode;

    public function __construct(
        string $person,
        string $tense = self::TENSE_PRESENT,
        string $mode = self::MODE_INDICATIVE
    ) {
        $this->person = $person;
        $this->tense = $tense;
        $this->mode = $mode;
    }

    public function getPerson(): string
    {
        return $this->person;
    }

    public function getTense(): string
    {
        return $this->tense;
    }

    public function getMode(): string
    {
        return $this->mode;
    }
}
