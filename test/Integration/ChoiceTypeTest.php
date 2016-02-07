<?php
namespace Greg0ire\EnumBundle\Tests\Integration;

use Greg0ire\EnumBundle\BaseEnum;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Form\Test\TypeTestCase;

final class DummyEnum extends BaseEnum
{
    const FIRST = 42,
        SECOND = 'some_value';
}

class ChoiceTypeTest extends TypeTestCase
{
    public function testChoicesAreFlippedLikeTheyShould()
    {
        $form = $this->factory->create(
            $this->getTypeName(),
            null,
            array(
                'choices' => DummyEnum::getChoices('label_dummy_%s'),
            )
        );
        $form->submit('some_value');
        $this->assertEquals('some_value', $form->getData());
    }

    public function getTypeName()
    {
        return version_compare(Kernel::VERSION, '2.8', '>=') ?
            'Symfony\Component\Form\Extension\Core\Type\ChoiceType':
            'choice';
    }
}
