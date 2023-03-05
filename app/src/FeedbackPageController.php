<?php

namespace SilverStripe\Feedback;

use PageController;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

class FeedbackPageController extends PageController
{

    private static $allowed_actions = ['Form'];

    public function Form()
    {
        $fields = new FieldList(
            new TextField('FirstName', 'First Name'),
            new TextField('LastName', 'Last Name'),
            new EmailField('Email'),
            new TextareaField('Message')
        );
        $actions = new FieldList(
            FormAction::create('submit')->setTitle('Submit')
        );
        return new Form($this, 'Form', $fields, $actions);
    }

    public function submit($data, $form)
    {
        $message = FeedbackMessage::create();
        $message->FirstName = $data['FirstName'];
        $message->LastName = $data['LastName'];
        $message->Email = $data['Email'];
        $message->Message = $data['Message'];
        $message->FeedbackPageID = $this->ID;
        $message->write();

        $form->sessionMessage('Thanks for your feedback!', 'good');

        return $this->redirectBack();
    }

}
