<?php

use SilverStripe\Dev\SapphireTest;
use SilverStripe\Feedback\Forms\NameField;
use SilverStripe\Forms\RequiredFields;

class FirstNameValidationTest extends SapphireTest
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
        $this->field = (new NameField('FirstName', 'First Name'))->setMaxLength(20);
        $this->assertInstanceOf(NameField::class, $this->field);

        $this->requiredValidator = new RequiredFields(['FirstName']);
        $this->assertInstanceOf(RequiredFields::class, $this->requiredValidator);

        // valid name should pass validation
        $this->assertValidationEquals(true, 'John');

        // names with invalid characters should fail validation
        $this->assertValidationEquals(false, 'John1');
        $this->assertValidationEquals(false, 'Sir John');
        $this->assertValidationEquals(false, 'St.John');
        $this->assertValidationEquals(false, 'John!');
        $this->assertValidationEquals(false, 'John.');

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
