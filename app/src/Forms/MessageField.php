<?php

namespace App\Feedback\Forms;

use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;

class MessageField extends TextareaField
{

    public function Type()
    {
        return 'textarea';
    }

    public function validate($validator)
    {
        // we will regard the submission as valid unless it fails validation for some reason
        $isValid = true;

        // trim whitespace from beginning and end of the message
        $this->value = trim($this->value ?? '');

        // field name to be used in validation messages
        $fieldName = strip_tags($this->Title() ? $this->Title() : $this->getName());

        $fieldIsRequired = ($validator instanceof RequiredFields && $validator->fieldIsRequired($this->name));

        if (empty($this->value)) {
            // they have submitted an empty value or only whitespace
            if ($fieldIsRequired) {
                $validator->validationError(
                    $this->name,
                    _t(
                        'SilverStripe\\Feedback\\Forms\\MessageField.VALIDATEREQUIRED',
                        '{name} is required',
                        ['name' => $fieldName]
                    ),
                    'validation'
                );
                $isValid = false;
            }
        } else {
            if (!is_null($this->maxLength) && mb_strlen($this->value ?? '') > $this->maxLength) {
                $name = strip_tags($this->Title() ? $this->Title() : $this->getName());
                $validator->validationError(
                    $this->name,
                    _t(
                        'SilverStripe\\Forms\\TextField.VALIDATEMAXLENGTH',
                        'The value for {name} must not exceed {maxLength} characters in length',
                        ['name' => $name, 'maxLength' => $this->maxLength]
                    ),
                    "validation"
                );
                $isValid = false;
            }
        }
        if (!parent::validate($validator)) {
            $isValid = false;
        }
        return $isValid;
    }

}
