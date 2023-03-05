<?php

namespace SilverStripe\Feedback;

use PageController;
use Feedback\Forms\MessageField;
use Feedback\Forms\NameField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;

class FeedbackPageController extends PageController
{

    private static $allowed_actions = ['Form'];

    public function Form()
    {

        $fields = new FieldList([
            (new NameField('FirstName', 'First Name'))->setMaxLength(20),
            (new NameField('LastName', 'Last Name'))->setMaxLength(20),
            (new EmailField('Email')),
            (new MessageField('Message'))->setMaxLength(255)
        ]);

        $actions = new FieldList(
            FormAction::create('submit')->setTitle('Submit')
        );

        $requiredFields = new RequiredFields(['FirstName', 'LastName', 'Email', 'Message']);

        return new Form($this, 'Form', $fields, $actions, $requiredFields);
    }

    public function submit($data, $form)
    {
        $message = FeedbackMessage::create();
        $message->FirstName = $data['FirstName'];
        $message->LastName = $data['LastName'];
        $message->Email = $data['Email'];
        $message->Message = $data['Message'];
        $message->write();

        $form->sessionMessage('Thanks for your feedback!', 'good');

        return $this->redirectBack();
    }

}
