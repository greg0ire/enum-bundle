<?php

namespace Greg0ire\EnumBundle;

use Greg0ire\EnumBundle\Bundle\BootEnum;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Greg0ireEnumBundle extends Bundle
{
    public function boot()
    {
        if ($this->container->hasParameter('greg0ire_enum.formatter')) {
            $serviceFormatter = $this->container->get($this->container->getParameter('greg0ire_enum.formatter'));
            BaseEnum::setFormatter($serviceFormatter);
        }
    }
}
