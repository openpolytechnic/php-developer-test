<?php
/*

This class represents Feedback Control page extends PageController class
- Prepare Form feilds
- Submit method
- Group Feedback data by date for renedering to the template

Open Polutenchinc - PHP Developer Code Test
Developed by: Aladdin Tbakhi
Version 1.0

*/
namespace { 
    use SilverStripe\Forms\FieldList; 
    use SilverStripe\Forms\TextField;
    use SilverStripe\Forms\EmailField;
    use SilverStripe\Forms\TextareaField;
    use SilverStripe\Forms\FormAction;
    use SilverStripe\Forms\Form;
    use SilverStripe\Forms\RequiredFields;
    use SilverStripe\ORM\GroupedList;




    class FeedbackPageController extends PageController 
    {
      
        private static $allowed_actions = ['Form'];
        
        /* 
        Form Method : prepaer the form feilds
        @return form object
        */
        public function Form() 
        { 
            //$Stats = "AAAA";

            $fields = new FieldList( 
                new TextField('FirstName'), 
                new TextField('LastName'), 
                new EmailField('Email'), 
                new TextareaField('Message')
            ); 
            $actions = new FieldList( 
                FormAction::create('clearForm', 'Reset')->setAttribute('type', 'reset'),
                new FormAction('doSubmitForm', 'Submit') 
            ); 

            //Empty value is not valid
            $required = new RequiredFields('FirstName', 'LastName', 'Email', 'Message');

            $form = new Form($this, 'Form', $fields, $actions, $required); 

            return $form;

        }

        /* 
        Submit Method : 
            - Prepare form data
            - Validate via a method in Feedback Object & FeebackValid class
            - Write data to the ORM/database
            - Show success/failed messages
        @return to Feedback page with session message
        */
        public function doSubmitForm($data, $form)
        {
      
            
            $Feedback = FeedbackObject::create();

            //Validate form
            $validationResult = $Feedback->validate();
            $form->setSessionValidationResult($validationResult);
            $form->setSessionData($form->getData());
   
      
            //Store data
            $Feedback->FirstName = $data['FirstName'];
            $Feedback->LastName = $data['LastName'];
            $Feedback->Email = $data['Email'];
            $Feedback->Message = $data['Message'];
            $Feedback->FeedbackPageID = $this->ID;
            $Feedback->write();
        
            $form->sessionMessage('Thanks for your Feedback!','good');
        
            return $this->redirectBack();  
        }
        
        //Group Feedback data by date for renedering Stats to the template
        public function getGroupedFeedbacksByDate() 
        {
            return GroupedList::create(FeedbackObject::get()->sort('Created','DESC'));
        }

   

    } 

}
