<?php

namespace App\Feedback;

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataQuery;

class FeedbackMessage extends DataObject
{

    /**
     * The name of the table in the database
     *
     * @var string
     */
    private static $table_name = 'FeedbackMessage';

    /**
     * Model Schema (Database column definitions)
     *
     * Note RFC3696 : email addresses may be up to 320 characters long
     *
     * @var array
     */
    private static $db = [
        'FirstName' => 'Varchar(20)',
        'LastName' => 'Varchar(20)',
        'Email' => 'Varchar(320)',
        'Message' => 'Varchar(255)'
    ];

    /**
     *
     * The default sorting order of data if a user has not specified sorting
     *
     * @var array
     */
    private static $default_sort = ['FirstName', 'Email', 'Created'];

    /**
     * Fields that are searchable in the Admin control-panel
     *
     * @var array
     */
    private static $searchable_fields = [
        'FirstName',
        'LastName',
        'Email'
    ];

    /**
     * Which data columns to show in Admin control-panel and CSV export, and the text labels of those columns
     *
     * @var array
     */
    private static $summary_fields = [
        'FirstName' => 'First Name',
        'LastName' => 'Last Name',
        'Email' => 'Email',
        'Message' => 'Message',
        'Created' => 'Submitted Date'
    ];

    /**
     * Returns a summary of FeedbackMessage submissions grouped by the day of FeedbackMessage.Created
     *
     * @return DataList
     */
    public static function getDailySummary()
    {
        $dataQuery = new DataQuery(self::class);
        $dataQuery->selectField("DATE_FORMAT(Created, '%Y%m%d')", 'submissionsDate');
        $dataQuery->selectField("COUNT(*)", 'submissionsCount');
        $dataQuery->groupby('submissionsDate')->sort('submissionsDate', 'DESC');

        return self::get()->setDataQuery($dataQuery);
    }

}
