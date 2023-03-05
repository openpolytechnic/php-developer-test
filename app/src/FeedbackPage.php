<?php

namespace SilverStripe\Feedback;

use Page;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\FieldType\DBDate;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\View\ArrayData;

class FeedbackPage extends Page
{

    // Get date and submissions
    public function getFeedbackSummary()
    {
        $list = ArrayList::create();
        
        $query = SQLSelect::create()
            ->setFrom("FeedbackMessage")
            ->setSelect(['Created',
                "DATE_FORMAT(Created, '%Y%m%d') AS submissionsDate",
                'COUNT(*) AS submissionsCount']
            )
            ->setGroupBy('submissionsDate')
            ->setOrderBy('submissionsDate', 'DESC')
            ->setLimit(10);

        $result = $query->execute();

        if ($result) {
            while ($record = $result->nextRecord()) {
                // push date and submissions to array
                // cast the submissions date to an object so the template can stylise it
                // note: format documentation: https://gist.github.com/y-gagar1n/8469484
                $submissionsSummaryDate = DBDate::create();
                $submissionsSummaryDate->setValue(strtotime($record["Created"]));

                $list->push(ArrayData::create([
                        'submissionsDate' => $submissionsSummaryDate,
                        'submissionsCount' => $record["submissionsCount"]
                ]));
            }
        }

        return $list;
    }

}
