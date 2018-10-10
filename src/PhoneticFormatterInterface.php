<?php

declare(strict_types=1);

namespace Phrench;

interface PhoneticFormatterInterface
{
    public function fix(string $conjugationToFix): string;

    public function supports(string $infinitive): bool;
}
