<?php

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Feedback\Forms\EmailField;
use SilverStripe\Forms\RequiredFields;

class EmailValidationTest extends SapphireTest
{

    private $field;
    private $requiredValidator;

    private function assertValidationEquals($expectedValue, $testValue, $message = '')
    {
        $this->field->setValue($testValue);
        $this->assertEquals($expectedValue, $this->field->validate($this->requiredValidator));
    }

    public function testTest()
    {
        $this->field = (new EmailField('Email'))->setMaxLength(320);
        $this->assertInstanceOf(EmailField::class, $this->field);

        $this->requiredValidator = new RequiredFields(['Email']);
        $this->assertInstanceOf(RequiredFields::class, $this->requiredValidator);

        // valid email should pass validation
        $this->assertValidationEquals(true, 'test@example.com');

        // invalid email patterns should fail validation
        $this->assertValidationEquals(false, 'test@example');
        $this->assertValidationEquals(false, 'test@example.com.');
        $this->assertValidationEquals(false, '@example.com');
        $this->assertValidationEquals(false, 'test@');
        $this->assertValidationEquals(false, 'test@test@example.com');
        $this->assertValidationEquals(false, 'test@test@example.com');
        $this->assertValidationEquals(false, 'test@example.com/test');
        $this->assertValidationEquals(false, '<test>@example.com');

        // name over 21 letters long should fail validation
        $this->assertValidationEquals(false, str_repeat('a', 21));
        $this->assertValidationEquals(false, str_repeat('a', 200));

        // email of less than or equal to 320 letters should pass validation
        for ($i = 1; $i <= 308; $i++) {
            $this->assertValidationEquals(true, str_repeat('a', $i) . '@example.com');
        }

        // email over 320 letters long should fail validation
        $this->assertValidationEquals(false, str_repeat('a', 310) . '@example.com');

        // empty email should fail validation
        $this->assertValidationEquals(false, '');

        // whitespace-only should fail validation
        $this->assertValidationEquals(false, '  ');
        $this->assertValidationEquals(false, ' ');
        $this->assertValidationEquals(false, '  ');
    }

}
