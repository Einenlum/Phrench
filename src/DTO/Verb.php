<?php

declare(strict_types=1);

namespace Phrench\DTO;

class Verb
{
    const FIRST_GROUP = 'first_group';
    const SECOND_GROUP = 'second_group';
    const THIRD_GROUP = 'fake_dirty_group_where_all_crazy_shit_happens';

    private $group;
    private $infinitive;
    private $stem;

    public function __construct(string $group, string $infinitive)
    {
        $this->group = $group;
        $this->infinitive = $infinitive;
        $this->stem = $this->deduceStem();
    }

    public function isFirstGroup(): bool
    {
        return $this->group === self::FIRST_GROUP;
    }

    public function isSecondGroup(): bool
    {
        return $this->group === self::SECOND_GROUP;
    }

    public function isThirdGroup(): bool
    {
        return $this->group === self::THIRD_GROUP;
    }

    public function getStem(): string
    {
        return $this->stem;
    }

    private function deduceStem(): string
    {
        $getBefore = function(string $suffix) {
            return substr(
                $this->infinitive,
                0,
                strlen($this->infinitive) - strlen($suffix)
            );
        };
        if ($this->isFirstGroup()) {
            return $getBefore('er');
        }

        if ($this->isSecondGroup()) {
            return $getBefore('ir');
        }

        return 'LolThirdGroupLolSorryWhatWereYouThinking?';
    }
}
