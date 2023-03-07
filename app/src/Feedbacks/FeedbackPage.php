<?php
/*

This class represents Feedback Page type extends from Page class

Open Polutenchinc - PHP Developer Code Test
Developed by: Aladdin Tbakhi
Version 1.0

*/

namespace {

    class FeedbackPage extends Page 
    {
        //Page has many Feebacks Objects, each feedback is an object
       private static $has_many = [
            'Feedbacks' => FeedbackObject::class,
        ];

    }
    
}

