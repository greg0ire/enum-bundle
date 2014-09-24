# EnumBundle

Integrates [greg0ire/enum][1] in a Symfony2 project. This actually not a real bundle
yet but :

- it has a dependency on symfony/form
- it could become a real bundle someday, if something needs to be configured

## Installation

    composer require greg0ire/enum-bundle

## Usage

The bundle provides its own `BaseEnum` class. It inherits from `greg0ire/enum`'s
`BaseEnum` class and provides an additional method, `getChoiceList()`, which
is meant to be used as value for the `choice_list` option of a choice widget.
It has a mandatory parameter, which is a `sprintf` format string and let's you choose
how to generate your labels.

```php
<?php
use Greg0ire\EnumBundle\BaseEnum;

final class ColorType extends BaseEnum
{
    const
        BLACK_WHITE = 'black-white',
        COLOR       = 'color',
        COLORIZED   = 'colorized' ;
}
```

A few moments later, in another file…

```php
<?php

class MyType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'aspect_ratio',
            'choice',
            array('choice_list' => ColorType::getChoiceList('color_type_%s')
        );
    }
}
```

You then need to create translations for :

- `color_type_black-white`
- `color_type_color`
- `color_type_colorized`

[1]: https://packagist.org/packages/greg0ire/enum

