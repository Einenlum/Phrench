# Phrench

What if French was a PHP project?

## Use

```php
<?php
use Phrench\Conjugator\Factory;
use Phrench\DTO\ConjugationModality;
use Phrench\DTO\Verb;

$conjugator = Factory::build();

$verb = new Verb(Verb::FIRST_GROUP, 'manger');
$modality = new ConjugationModality(
  ConjugationModality::PERSON_FIRST_PLURAL,
  ConjugationModality::TENSE_PRESENT
);

$conjugator->conjugate($verb, $modality); // returns "mangeons"
```

## Tests

`composer test`
