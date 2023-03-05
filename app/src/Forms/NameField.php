<?php

namespace Feedback\Forms;

use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;

class NameField extends TextField
{

    public function Type()
    {
        return 'text';
    }

    public function validate($validator)
    {
        // we will regard the submission as valid unless it fails validation for some reason
        $isValid = true;

        // trim whitespace from beginning and end of the name
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
                        'Feedback\\Forms\\NameField.VALIDATENAMEREQUIRED',
                        '{name} is required',
                        ['name' => $fieldName]
                    ),
                    'validation'
                );
                $isValid = false;
            }
        } elseif (preg_replace('/[^a-zA-Z]/', '', $this->value) !== $this->value) {
            // this value contains non-allowed characters
            $validator->validationError(
                $this->name,
                _t(
                    'Feedback\\Forms\\NameField.VALIDATENAMELETTERSONLY',
                    '{name} only allows letters',
                    ['name' => $fieldName]
                ),
                'validation'
            );
            $isValid = false;
        }
        if (!parent::validate($validator)) {
            $isValid = false;
        }

        return $isValid;
    }

}
