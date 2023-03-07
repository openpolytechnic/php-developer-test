<?php
/*

This class has the required methods to validate the form fields

Open Polutenchinc - PHP Developer Code Test
Developed by: Aladdin Tbakhi
Version 1.0

*/
use SilverStripe\CMS\Model\SiteTree;

class FeedbackValid extends SiteTree
{

    // Validate max characters per feild value @param: String feild value, Int max chars 
    public static function ExceedLimit($CheckText, $max) 
    {
      
        $check = false;
        if(!empty($CheckText) && strlen($CheckText) > $max ) {
            $check = true;
        }
        return $check;

    }

    // Validate - [A-Z] of both lower & upper cases is allowed per feild value @param: String feild value
    public static function OnlyChars($CheckText) 
    {
      
        $check = false;
        if(!empty($CheckText) && !preg_match("/^[a-zA-Z]+$/", $CheckText) == 1) {
            $check = true;
        }
        return $check;

    }

}