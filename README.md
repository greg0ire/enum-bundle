**This package is abandoned in favor of [greg0ire/enum][1]**

# EnumBundle

Integrates [greg0ire/enum][1] in a Symfony2 project. This actually not a real bundle
yet but :

- it has a dependency on symfony/form
- it could become a real bundle someday, if something needs to be configured

[![Build Status][2]](https://travis-ci.org/greg0ire/enum-bundle)

## Installation

    composer require greg0ire/enum-bundle

## Usage

The bundle provides its own `BaseEnum` class. It inherits from `greg0ire/enum`'s
`BaseEnum` class and provides an additional method, `getChoices()`, which
is meant to be used as value for the `choices` option of a choice widget.
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
            array('choices' => ColorType::getChoices('color_type_%s'))
        );
    }
}
```

You then need to create translations for :

- `color_type_black-white`
- `color_type_color`
- `color_type_colorized`

The first argument to `getChoices()` is optional, and the value will be used
directly as a label should you choose not to specify it. This makes sense if
you decide to have a translation catalogue just for your enumeration.
The second argument, `choicesAsValues` only takes effect if your symfony version
is < 3.0 and >= 2.7. It defaults to `false` for the moment, so that B.C. is
kept. If you use symfony >= 2.8 and < 3.0, you will get a deprecation notice
unless you set it to true and set `choices_as_values` option to `true`.

[1]: https://packagist.org/packages/greg0ire/enum
[2]: https://travis-ci.org/greg0ire/enum-bundle.svg?branch=master
