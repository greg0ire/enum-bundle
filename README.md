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
            array('choice_list' => ColorType::getChoiceList('color_type_%s'))
        );
    }
}
```

Alternatively, you can use the `choices` option :

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
Possibility of configuration of the translation chain

In ```AppKernel.php```

```php

$bundles = array(

    /** other bundles */
    new Greg0ire\EnumBundle\Greg0ireEnumBundle(),

);

```

In ```config.yml``` add :

you can choose between **underscore** or **camelize**

```yml

greg0ire_enum:
    chain: underscore

```

You then need to create translations for :

- `color_type_black-white`
- `color_type_color`
- `color_type_colorized`

The argument to both `getChoiceList()` and `getChoices()` is optional, and the
value will be used directly as a label should you choose not to specify it.
This makes sense if you decide to have a translation catalogue just for your
enumeration.

[1]: https://packagist.org/packages/greg0ire/enum
[2]: https://travis-ci.org/greg0ire/enum-bundle.svg?branch=master
