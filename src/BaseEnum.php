<?php

namespace Greg0ire\EnumBundle;

use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Greg0ire\Enum\BaseEnum as LibraryEnum;

abstract class BaseEnum extends LibraryEnum
{
    /**
     * @return ChoiceList a symfony choice list, ready for use as the choice_list
     *                    option of a symfony choice widget
     */
    public static function getChoiceList($pattern)
    {
        $constants = self::getConstants();

        return new ChoiceList(
            $values = array_values($constants),
            array_map(
                function ($element) use ($pattern) {
                    return sprintf(
                        $pattern,
                        $element
                    );
                },
                $values
            )
        );
    }

    /**
     * @return ChoiceList an associative array, ready for use with the choices
     *                    option of a symfony choice widget
     */
    public static function getChoices($pattern)
    {
        $constants = self::getConstants();

        return array_combine(
            $values = array_values($constants),
            array_map(
                function ($element) use ($pattern) {
                    return sprintf(
                        $pattern,
                        $element
                    );
                },
                $values
            )
        );
    }
}
