<?php

namespace SilverStripe\Feedback;

use SilverStripe\ORM\DataObject;

class FeedbackMessage extends DataObject
{

    private static $table_name = 'FeedbackMessage';

    /**
     * Model Schema
     *
     * Note RFC3696 : email addresses may be up to 320 characters long
     *
     * @var type
     */
    private static $db = [
        'FirstName' => 'Varchar(20)',
        'LastName' => 'Varchar(20)',
        'Email' => 'Varchar(320)',
        'Message' => 'Varchar(255)'
    ];

}
