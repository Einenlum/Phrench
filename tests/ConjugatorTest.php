<?php

declare(strict_types=1);

namespace Phrench\Tests;

use PHPUnit\Framework\TestCase;
use Phrench\Conjugator\Factory;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

class ConjugatorTest extends TestCase
{
    public function testFirstGroupPresent()
    {
        $conjugator = Factory::build();

        $tests = [
            'marcher' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'marche',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'marches',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'marche',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'marchons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'marchez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'marchent',
            ],
            'ramer' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'rame',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'rames',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'rame',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'ramons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'ramez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'rament',
            ],
            'conjuguer' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'conjugue',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'conjugues',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'conjugue',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'conjuguons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'conjuguez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'conjuguent',
            ],
            'lancer' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'lance',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'lances',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'lance',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'lançons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'lancez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'lancent',
            ],
            'manger' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'mange',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'manges',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'mange',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'mangeons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'mangez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'mangent',
            ],
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
