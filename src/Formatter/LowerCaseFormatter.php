<?php

namespace Greg0ire\EnumBundle\Formatter;

class LowerCaseFormatter implements FormatterInterface
{
    /**
     * @param $text
     * @return string
     */
    public function format($text)
    {
        return strtolower(strtr($text, ['.' => '_', '-' => '_']));
    }

}
