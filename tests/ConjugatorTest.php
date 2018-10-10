<?php

declare(strict_types=1);

namespace Phrench\Tests;

use PHPUnit\Framework\TestCase;
use Phrench\Conjugator\Factory;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

class ConjugatorTest extends TestCase
{
    private $conjugator;

    public function __construct()
    {
        parent::__construct();
        $this->conjugator = Factory::build();
    }

    public function testFirstGroupPresent()
    {
        $tests = [
            // Standards
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

            // Dangerous endings
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

            // Double consonants
            'appeler' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'appelle',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'appelles',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'appelle',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'appelons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'appelez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'appellent',
            ],

            // Bass accentuation is coming
            'acheter' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'achète',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'achètes',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'achète',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'achetons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'achetez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'achètent',
            ],
            'geler' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'gèle',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'gèles',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'gèle',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'gelons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'gelez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'gèlent',
            ],
            'mener' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'mène',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'mènes',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'mène',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'menons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'menez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'mènent',
            ],
            'peser' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'pèse',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'pèses',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'pèse',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'pesons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'pesez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'pèsent',
            ],
            'dépecer' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'dépèce',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'dépèces',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'dépèce',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'dépeçons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'dépecez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'dépècent',
            ],

            // Treble accentuation is changing
            'coopérer' => [
                ConjugationModality::PERSON_FIRST_SINGULAR  => 'coopère',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'coopères',
                ConjugationModality::PERSON_THIRD_SINGULAR  => 'coopère',
                ConjugationModality::PERSON_FIRST_PLURAL    => 'coopérons',
                ConjugationModality::PERSON_SECOND_PLURAL   => 'coopérez',
                ConjugationModality::PERSON_THIRD_PLURAL    => 'coopèrent',
            ],
        ];

        $this->assertSample($tests, Verb::FIRST_GROUP);
    }

    public function testSecondGroupPresent()
    {
        $tests = [
            'finir' => [
                ConjugationModality::PERSON_FIRST_SINGULAR => 'finis',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'finis',
                ConjugationModality::PERSON_THIRD_SINGULAR => 'finit',
                ConjugationModality::PERSON_FIRST_PLURAL => 'finissons',
                ConjugationModality::PERSON_SECOND_PLURAL => 'finissez',
                ConjugationModality::PERSON_THIRD_PLURAL => 'finissent',
            ],
            'choisir' => [
                ConjugationModality::PERSON_FIRST_SINGULAR => 'choisis',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'choisis',
                ConjugationModality::PERSON_THIRD_SINGULAR => 'choisit',
                ConjugationModality::PERSON_FIRST_PLURAL => 'choisissons',
                ConjugationModality::PERSON_SECOND_PLURAL => 'choisissez',
                ConjugationModality::PERSON_THIRD_PLURAL => 'choisissent',
            ],
            'agir' => [
                ConjugationModality::PERSON_FIRST_SINGULAR => 'agis',
                ConjugationModality::PERSON_SECOND_SINGULAR => 'agis',
                ConjugationModality::PERSON_THIRD_SINGULAR => 'agit',
                ConjugationModality::PERSON_FIRST_PLURAL => 'agissons',
                ConjugationModality::PERSON_SECOND_PLURAL => 'agissez',
                ConjugationModality::PERSON_THIRD_PLURAL => 'agissent',
            ],
        ];

        $this->assertSample($tests, Verb::SECOND_GROUP);
    }

    private function assertSample(array $sample, string $group)
    {
        foreach ($sample as $infinitive => $test) {
            $verb = new Verb($group, $infinitive);
            foreach ($test as $person => $expectedValue) {
                $modality = new ConjugationModality($person);
                $this->assertEquals(
                    $this->conjugator->conjugate($verb, $modality),
                    $expectedValue
                );
            }
        }
    }
}
