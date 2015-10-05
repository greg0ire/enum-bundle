<?php

namespace Greg0ire\EnumBundle;

use Greg0ire\Enum\BaseEnum as LibraryEnum;
use Greg0ire\EnumBundle\Formatter\FormatterInterface;

abstract class BaseEnum extends LibraryEnum
{
    public static $formatter;

    /**
     * @param  mixed string|null a sprintf compatible pattern for generating labels
     *
     * @return array an associative array, ready for use with the choices
     *                    option of a symfony choice widget
     */
    public static function getChoices($pattern = null)
    {
        $constants = self::getConstants();

        return array_combine(
            $values = array_values($constants),
            self::getLabelArray($values, $pattern)
        );
    }

    public static function getLabelArray($values, $pattern)
    {
        return $pattern === null ?
            $values:
            array_map(
                function ($element) use ($pattern) {
                    return BaseEnum::format($pattern, $element);
                },
                $values
            );
    }

    protected static function format($pattern, $element)
    {
        $formatter = BaseEnum::$formatter;
        $chain = sprintf($pattern, $element);

        if ($formatter == null) {
            return $chain;
        }

        return $formatter->format($chain);
    }

    public static function setFormatter(FormatterInterface $formatter)
    {
        BaseEnum::$formatter = $formatter;
    }
}
