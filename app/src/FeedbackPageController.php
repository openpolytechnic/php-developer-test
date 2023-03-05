<?php

namespace SilverStripe\Feedback;

use PageController;
use SilverStripe\Feedback\Forms\MessageField;
use SilverStripe\Feedback\Forms\NameField;
use SilverStripe\Feedback\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\View\Requirements;

class FeedbackPageController extends PageController
{

    private static $allowed_actions = ['feedbackForm'];

    protected function init()
    {
        parent::init();
        Requirements::css('themes/simple/css/feedback.css');
    }

    public function feedbackForm()
    {

        $fields = new FieldList([
            (new NameField('FirstName', 'First Name'))->setMaxLength(20),
            (new NameField('LastName', 'Last Name'))->setMaxLength(20),
            (new EmailField('Email'))->setMaxLength(320),
            (new MessageField('Message'))->setMaxLength(255)
        ]);

        $actions = new FieldList(
            FormAction::create('submit')->setTitle('Submit')
        );

        $requiredFields = new RequiredFields(['FirstName', 'LastName', 'Email', 'Message']);

        return new Form($this, 'feedbackForm', $fields, $actions, $requiredFields);
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
