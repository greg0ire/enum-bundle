<?php

namespace Greg0ire\EnumBundle;

use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Greg0ire\Enum\BaseEnum as LibraryEnum;

abstract class BaseEnum extends LibraryEnum
{
    /**
     * @param  mixed string|null a sprintf compatible pattern for generating labels
     * @param  Closure  callback optional parameter modify pattern
     *
     * @return ChoiceList a symfony choice list, ready for use as the choice_list
     *                    option of a symfony choice widget
     */
    public static function getChoiceList($pattern = null, \Closure $callback = null)
    {
        $constants = self::getConstants();

        return new ChoiceList(
            $values = array_values($constants),
            self::getLabelArray($values, $pattern, $callback)
        );
    }

    /**
     * @param  mixed string|null a sprintf compatible pattern for generating labels
     * @param  Closure  callback optional parameter modify pattern
     *
     * @return ChoiceList an associative array, ready for use with the choices
     *                    option of a symfony choice widget
     */
    public static function getChoices($pattern = null, \Closure $callback = null)
    {
        $constants = self::getConstants();

        return array_combine(
            $values = array_values($constants),
            self::getLabelArray($values, $pattern, $callback)
        );
    }

    public static function getLabelArray($values, $pattern, \Closure $callback = null)
    {
        return $pattern === null ?
            $values:
            array_map(
                function ($element) use ($pattern, $callback) {
                    return sprintf(
                        $pattern,
                        ($callback)? $callback($element) : $element
                    );
                },
                $values
            );
    }
}
