<?php

namespace App\Feedback;

use Page;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\FieldType\DBDate;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\View\ArrayData;

class FeedbackPage extends Page
{

    public function getFeedbackSummary()
    {
        return FeedbackMessage::getDailySummary()->limit(10);
    }

}
