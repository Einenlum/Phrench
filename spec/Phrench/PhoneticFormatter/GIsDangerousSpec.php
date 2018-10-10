<?php

namespace spec\Phrench\PhoneticFormatter;

use Phrench\PhoneticFormatter\GIsDangerous;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Phrench\PhoneticFormatterInterface;

class GIsDangerousSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(GIsDangerous::class);
        $this->shouldImplement(PhoneticFormatterInterface::class);
    }

    function it_fixes_mispronouncing_conjugations()
    {
        $this->fix('mange')->shouldReturn('mange');
        $this->fix('manges')->shouldReturn('manges');
        $this->fix('mangons')->shouldReturn('mangeons');
        $this->fix('logez')->shouldReturn('logez');
        $this->fix('logons')->shouldReturn('logeons');
        $this->fix('ragons')->shouldReturn('rageons');
        $this->fix('rage')->shouldReturn('rage');
        $this->fix('figent')->shouldReturn('figent');
    }

    function it_only_supports_verbs_ending_by_ger()
    {
        $this->supports('rincer')->shouldReturn(false);
        $this->supports('momifier')->shouldReturn(false);
        $this->supports('rêver')->shouldReturn(false);
        $this->supports('rigoler')->shouldReturn(false);
        $this->supports('bourlinguer')->shouldReturn(false);
        $this->supports('répéter')->shouldReturn(false);
        $this->supports('croire')->shouldReturn(false);

        $this->supports('manger')->shouldReturn(true);
        $this->supports('loger')->shouldReturn(true);
        $this->supports('rager')->shouldReturn(true);
        $this->supports('figer')->shouldReturn(true);
    }
}
