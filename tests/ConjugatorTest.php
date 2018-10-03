<?php

declare(strict_types=1);

namespace Phrench\Tests;

use PHPUnit\Framework\TestCase;
use Phrench\Conjugator\Factory;
use Phrench\DTO\Verb;
use Phrench\DTO\ConjugationModality;

class ConjugatorTest extends TestCase
{
    public function testFirstGroupPresent()
    {
        $conjugator = Factory::build();

        $verb = new Verb(
            Verb::FIRST_GROUP,
            'marcher'
        );

        $tests = [
            'marcher' => [
                ConjugationModality::PERSON_FIRST_SINGULAR => 'marche',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'marches',
                ConjugationModality::PERSON_THIRD_SINGULAR => 'marche',
                ConjugationModality::PERSON_FIRST_PLURAL => 'marchons',
                ConjugationModality::PERSON_SECOND_PLURAL => 'marchez',
                ConjugationModality::PERSON_THIRD_PLURAL => 'marchent',
            ],
            'ramer' => [
                ConjugationModality::PERSON_FIRST_SINGULAR => 'rame',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'rames',
                ConjugationModality::PERSON_THIRD_SINGULAR => 'rame',
                ConjugationModality::PERSON_FIRST_PLURAL => 'ramons',
                ConjugationModality::PERSON_SECOND_PLURAL => 'ramez',
                ConjugationModality::PERSON_THIRD_PLURAL => 'rament',
            ]
        ];

        foreach ($tests as $infinitive => $test) {
            $verb = new Verb(Verb::FIRST_GROUP, $infinitive);
            foreach ($test as $person => $expectedValue) {
                $modality = new ConjugationModality($person);
                $this->assertEquals(
                    $conjugator->conjugate($verb, $modality),
                    $expectedValue
                );
            }
        }
    }
}
