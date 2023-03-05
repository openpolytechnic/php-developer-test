<?php

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Feedback\Forms\NameField;
use SilverStripe\Forms\RequiredFields;

class LastNameValidationTest extends SapphireTest
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
        $this->field = (new NameField('LastName', 'Last Name'))->setMaxLength(20);
        $this->assertInstanceOf(NameField::class, $this->field);

        $this->requiredValidator = new RequiredFields(['LastName']);
        $this->assertInstanceOf(RequiredFields::class, $this->requiredValidator);

        // valid name should pass validation
        $this->assertValidationEquals(true, 'Brown');

        // names with invalid characters should fail validation
        $this->assertValidationEquals(false, 'Brown8');
        $this->assertValidationEquals(false, 'Brown 2nd');
        $this->assertValidationEquals(false, 'Brown-Smith');
        $this->assertValidationEquals(false, 'Brown!');
        $this->assertValidationEquals(false, 'Brown.');

        // name of less than or equal to 20 letters should pass validation

        for ($i = 1; $i <= 20; $i++) {
            $this->assertValidationEquals(true, str_repeat('a', $i));
        }

        // name over 21 letters long should fail validation
        $this->assertValidationEquals(false, str_repeat('a', 21));
        $this->assertValidationEquals(false, str_repeat('a', 200));

        // empty name should fail validation
        $this->assertValidationEquals(false, '');

        // whitespace-only should fail validation
        $this->assertValidationEquals(false, '  ');
        $this->assertValidationEquals(false, ' ');
        $this->assertValidationEquals(false, '  ');

        // make sure all alphabetical letters are allowed
        foreach (array_merge(range('A', 'Z'), range('a', 'z')) as $letter) {
            $this->assertValidationEquals(true, $letter);
        }
    }

}
