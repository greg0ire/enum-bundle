<?php

namespace Greg0ire\EnumBundle;

use Greg0ire\Enum\BaseEnum as LibraryEnum;
use Symfony\Component\HttpKernel\Kernel;

abstract class BaseEnum extends LibraryEnum
{
    /**
     * @param  mixed string|null a sprintf compatible pattern for generating labels
     * @param  boolean           whether choicesAsValues should be returned.
     *                           Only has effect when symfony >= 2.7 and < 3.0
     *
     * @return array an associative array, ready for use with the choices
     *                    option of a symfony choice widget
     */
    public static function getChoices($pattern = null, $choicesAsValues = false)
    {
        if (version_compare(Kernel::VERSION, '3.0', '>=')) {
            $choicesAsValues = true;
        }
        if (version_compare(Kernel::VERSION, '2.7', '<')) {
            $choicesAsValues = false;
        }
        $constants = self::getConstants();

        $choices = array_combine(
            $values = array_values($constants),
            self::getLabelArray($values, $pattern)
        );

        return $choicesAsValues ? array_flip($choices) : $choices;
    }

    public static function getLabelArray($values, $pattern)
    {
        return $pattern === null ?
            $values:
            array_map(
                function ($element) use ($pattern) {
                    return sprintf(
                        $pattern,
                        $element
                    );
                },
                $values
            );
    }
}
