<?php

use App\Feedback\Forms\MessageField;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Forms\RequiredFields;

class MessageValidationTest extends SapphireTest
{

    private $field;
    private $requiredValidator;
    private $validMessage;

    private function assertValidationEquals($expectedValue, $testValue, $message = '')
    {
        $this->field->setValue($testValue);
        $this->assertEquals($expectedValue, $this->field->validate($this->requiredValidator));
    }

    public function testTest()
    {
        $this->validMessage = <<<MSG
This a test message of feedback, it is only for testing. It isn't really important content in any way, it is only to test that the validation is working. Really, most people would use a Lorem-Ipsum generator for this, but ... this actually makes sense!'
MSG;

        $this->field = (new MessageField('Message'))->setMaxLength(255);
        $this->assertInstanceOf(MessageField::class, $this->field);

        $this->requiredValidator = new RequiredFields(['Message']);
        $this->assertInstanceOf(RequiredFields::class, $this->requiredValidator);

        // valid message should pass validation (252 chars)
        $this->assertValidationEquals(true, $this->validMessage);

        // excessively long message should fail validation
        $this->assertValidationEquals(false, $this->validMessage . ' Hear!');

        // empty message should fail validation
        $this->assertValidationEquals(false, '');

        // whitespace-only should fail validation
        $this->assertValidationEquals(false, '  ');
        $this->assertValidationEquals(false, ' ');
        $this->assertValidationEquals(false, '  ');

    }

}
