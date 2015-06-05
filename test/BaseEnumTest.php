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
        $formatter->format('change me')->willReturn('change that too');
        $formatter->format('change me')->willReturn('change that too');
        $formatter->format('change me')->willReturn('change that too');
        $formatter->format('change me')->willReturn('change that too');
        $this->assertEquals(array('change that'), DummyEnum::getChoices('and change me too'));
        $this->assertEquals(array('change that too'), DummyEnum::getChoices());
    }
}
