<?php

namespace SilverStripe\Feedback;

use Page;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\FieldType\DBDate;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\View\ArrayData;

class FeedbackPage extends Page
{

    public function getDailySummary()
    {
        $result2 = FeedbackMessage::getDailySummary();
        return $result2;
    }

    public function getFeedbackSummary()
    {
        return FeedbackMessage::getDailySummary()->limit(10);
    }

}
