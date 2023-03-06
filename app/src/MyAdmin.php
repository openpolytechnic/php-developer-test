<?php

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Feedback\FeedbackMessage;

class MyAdmin extends ModelAdmin
{

    private static $menu_title = 'Feedback Submissions';
    private static $url_segment = 'feedbacks';
    private static $managed_models = [
        FeedbackMessage::class
    ];

}
