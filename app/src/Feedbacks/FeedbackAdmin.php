<?php
/*

This class represent the Feedback submissions page in admin side

Open Polutenchinc - PHP Developer Code Test
Developed by: Aladdin Tbakhi
Version 1.0

*/
    use SilverStripe\Admin\ModelAdmin;


    class FeedbackAdmin extends ModelAdmin {
        private static $managed_models = [
            //'FeedbackObject',
       
            'Feedback-Submissions' => [
                'dataClass' => FeedbackObject::class,
                'title' => 'Feedback Submissions'
            ],
       
        ];

        private static $url_segment = 'feedbacks'; // Url
        private static $menu_title = 'Feedbacks'; //title in left menue


        // Columns shows in CSV export file
        public function getExportFields() 
        {
            return [
                'FirstName' => 'First Name',
                'LastName' => 'Last Name',
                'Email' => 'Email',
                'Message' => 'Message',
                'Created' => 'Submitted Date',

            ];
        }
    }