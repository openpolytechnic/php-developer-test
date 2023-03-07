<?php 
/*

This class represents Feedback Object extends DataObject class
- Store Form Date
- Customise Model Admin page
- Validate Food
- Customise Submission date for showing Stats in the template

Open Polutenchinc - PHP Developer Code Test
Developed by: Aladdin Tbakhi
Version 1.0

*/

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList; 
use SilverStripe\Forms\TextField;


class FeedbackObject extends DataObject
{

    private static $db = [
        'FirstName' => 'Varchar',
        'LastName' => 'Varchar',
        'Email' => 'Varchar',
        'Message' => 'Text'
    ];

    // Feedback objects has one Feedback page
    private static $has_one = [
        'FeedbackPage' => FeedbackPage::class,
    ];

    // searchable fields in Feedback Submissions page in Admin
    private static $searchable_fields = [
        'FirstName',
        'LastName',
        'Email'
     ];

     // Componenet looks for columns in Feedback Submissions page in Admin
     private static $summary_fields = [
        'FirstName',
        'LastName',
        'Created'
     ];
     
     //Replace text
     private static $field_labels = [
        'Created' => 'Submitted date' 
     ];
  
     // Validate Feedback form by calling FeedbackValid Class that has all the validations methods.
    public function validate() 
    {
        
        $result = parent::validate();


        if(FeedbackValid::ExceedLimit($this->FirstName,20)){
            $result->addFieldError('FirstName', 'FirstName should not exceed 20 characters');
        }
        if(FeedbackValid::OnlyChars($this->FirstName)){
            $result->addFieldError('FirstName', 'FirstName should contains only characters!');
        }


        if(FeedbackValid::ExceedLimit($this->LastName,20)) {
            $result->addFieldError('LastName','LastName should not exceed 20 characters!');
        }
        if(FeedbackValid::OnlyChars($this->LastName)){
            $result->addFieldError('LastName', 'LastName should contains only characters!');
        }

        if(FeedbackValid::ExceedLimit($this->Message,255)) {
            $result->addFieldError('Message', 'Message should not exceed 255 characters!');
        }
        return $result;

    }

    //Prepare for grouping by Created property in FeedbackObject
    public function getDateCreated() 
    {
        return date('d M Y', strtotime($this->Created));
    }



}

