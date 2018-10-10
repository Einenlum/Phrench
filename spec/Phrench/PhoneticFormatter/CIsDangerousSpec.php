<?php

namespace spec\Phrench\PhoneticFormatter;

use Phrench\PhoneticFormatter\CIsDangerous;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Phrench\PhoneticFormatterInterface;

class CIsDangerousSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CIsDangerous::class);
        $this->shouldImplement(PhoneticFormatterInterface::class);
    }

    function it_fixes_mispronouncing_conjugations()
    {
        $this->fix('lances')->shouldReturn('lances');
        $this->fix('lancons')->shouldReturn('lançons');
        $this->fix('grincez')->shouldReturn('grincez');
        $this->fix('grincons')->shouldReturn('grinçons');
        $this->fix('rince')->shouldReturn('rince');
        $this->fix('rincez')->shouldReturn('rincez');
        $this->fix('rincons')->shouldReturn('rinçons');
    }

    function it_only_supports_verbs_ending_by_cer()
    {
        $this->supports('manger')->shouldReturn(false);
        $this->supports('soigner')->shouldReturn(false);
        $this->supports('mériter')->shouldReturn(false);
        $this->supports('gracier')->shouldReturn(false);
        $this->supports('rêver')->shouldReturn(false);
        $this->supports('divertir')->shouldReturn(false);
        $this->supports('sortir')->shouldReturn(false);
        $this->supports('aimer')->shouldReturn(false);

        $this->supports('grincer')->shouldReturn(true);
        $this->supports('lancer')->shouldReturn(true);
        $this->supports('rincer')->shouldReturn(true);
    }
}
