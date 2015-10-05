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
    public function testGetChoices()
    {
        $this->assertSame(
            array(
                42           => 'label_dummy_42',
                'some_value' => 'label_dummy_some_value'
            ),
            DummyEnum::getChoices('label_dummy_%s')
        );
        $this->assertSame(
            array(
                42           => 42,
                'some_value' => 'some_value'
            ),
            DummyEnum::getChoices()
        );
    }

    public function testFormatter()
    {
        $formatter = $this->prophesize(
            'Greg0ire\EnumBundle\Formatter\FormatterInterface'
        );
        BaseEnum::setFormatter($formatter->reveal());
        $formatter->format('label_dummy_42')->willReturn('label_dummy_42');
        $formatter->format('label_dummy_some_value')->willReturn('label_dummy_some_value');
        $this->assertEquals(
            array(
                42 => 'label_dummy_42',
                'some_value' => 'label_dummy_some_value'
            ),
            DummyEnum::getChoices('label_dummy_%s')
        );
        $this->assertEquals(
            array(
                42 => 42,
                'some_value' => 'some_value'
            ),
            DummyEnum::getChoices()
        );
    }
}
