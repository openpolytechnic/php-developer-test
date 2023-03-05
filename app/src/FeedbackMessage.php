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

    private static $default_sort = ['FirstName', 'Email', 'Created'];

    // Fields that are searchable in the Admin control-panel
    private static $searchable_fields = [
        'FirstName',
        'LastName',
        'Email'
    ];

    // Data as columns with column names in Admin control-panel and CSV export
    private static $summary_fields = [
        'FirstName' => 'First Name',
        'LastName' => 'Last Name',
        'Email' => 'Email',
        'Message' => 'Message',
        'Created' => 'Submitted Date'
    ];
}
