<?php

namespace Greg0ire\EnumBundle;

use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Greg0ire\Enum\BaseEnum as LibraryEnum;

abstract class BaseEnum extends LibraryEnum
{
    /**
     * @return ChoiceList a symfony choice list, ready for use inside a Symfony form
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
}
