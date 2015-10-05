<?php
namespace Greg0ire\EnumBundle\Tests\Formatter;

use Greg0ire\EnumBundle\Formatter\LowerCaseFormatter;

class LowerCaseFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $formatter = new LowerCaseFormatter();
        $this->assertEquals(
            $formatter->format('original translation key'), // change that with the expected result
            'original_translation_key' // change that with a real translation key
        );
    }
}
