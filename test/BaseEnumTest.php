<?php
namespace Greg0ire\EnumBundle\Tests;

use Greg0ire\EnumBundle\BaseEnum;
use Symfony\Component\HttpKernel\Kernel;

final class DummyEnum extends BaseEnum
{
    const FIRST = 42,
        SECOND = 'some_value';
}

class BaseEnumTest extends \PHPUnit_Framework_TestCase
{
    public function testGetChoices()
    {
        if (version_compare(Kernel::VERSION, '3.0', '>=')) {
            $this->assertSame(
                array(
                    'label_dummy_42' => 42,
                    'label_dummy_some_value' => 'some_value',
                ),
                DummyEnum::getChoices('label_dummy_%s', true)
            );
        } else {
            $this->assertSame(
                array(
                    42           => 'label_dummy_42',
                    'some_value' => 'label_dummy_some_value',
                ),
                DummyEnum::getChoices('label_dummy_%s')
            );
        }
        if (version_compare(Kernel::VERSION, '2.7', '<')) {
            $this->assertSame(
                array(
                    42           => 'label_dummy_42',
                    'some_value' => 'label_dummy_some_value',
                ),
                DummyEnum::getChoices('label_dummy_%s', true)
            );
        } else {
            $this->assertSame(
                array(
                    'label_dummy_42' => 42,
                    'label_dummy_some_value' => 'some_value',
                ),
                DummyEnum::getChoices('label_dummy_%s', true)
            );
        }
        $this->assertSame(
            array(
                42           => 42,
                'some_value' => 'some_value'
            ),
            DummyEnum::getChoices()
        );
    }
}
