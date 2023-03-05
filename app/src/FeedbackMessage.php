<?php

namespace SilverStripe\Feedback;

use SilverStripe\ORM\DataObject;

class FeedbackMessage extends DataObject
{

    private static $db = [
        'FirstName' => 'Varchar(255)',
        'LastName' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Message' => 'Text'
    ];

    private static $has_one = [
        'FeedbackPage' => FeedbackPage::class
    ];

    private static $table_name = 'FeedbackMessage';

}
