<?php

namespace Greg0ire\EnumBundle\Formatter;


interface FormatterInterface
{
    /**
     * @param $text
     * @return string
     */
    public function format($text);
}
