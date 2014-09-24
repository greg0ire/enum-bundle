<?php
namespace Greg0ire\EnumBundle\Tests;

use Greg0ire\EnumBundle\BaseEnum;

final class DummyEnum extends BaseEnum
{
    const FIRST = 42,
        SECOND = 'some_value';
}

class BaseEnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetChoiceList()
    {
        $this->assertInstanceOf(
            'Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList',
            $choiceList = DummyEnum::getChoiceList('label_dummy_%s')
        );
        $this->assertSame(
            'label_dummy_42',
            $choiceList->getRemainingViews()[0]->label
        );
        $this->assertSame(
            42,
            $choiceList->getRemainingViews()[0]->data
        );
    }

    public function testGetChoices()
    {
        $this->assertSame(
            array(
                42           => 'label_dummy_42',
                'some_value' => 'label_dummy_some_value'
            ),
            DummyEnum::getChoices('label_dummy_%s')
        );
    }
}
