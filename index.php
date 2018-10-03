<?php

use Phrench\DTO\Verb;
use Phrench\Conjugator\Factory;
use Phrench\DTO\ConjugationModality;

require_once(__DIR__.'/vendor/autoload.php');

$conjugator = Factory::build();

$verb = new Verb(
    Verb::FIRST_GROUP,
    'respirer'
);
$modality = new ConjugationModality(ConjugationModality::PERSON_FIRST_SINGULAR);

$conjugatedVerb = $conjugator->conjugate($verb, $modality);

var_dump(
    sprintf('Je %s', $conjugatedVerb)
);

