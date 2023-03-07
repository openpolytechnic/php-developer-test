<?php
/*

This class represent Test unit to test the validation methods in FeedbackValid class
Run by PHPUnit 
Command to run : ./vendor/bin/phpunit --testdox app/tests

Open Polutenchinc - PHP Developer Code Test
Developed by: Aladdin Tbakhi
Version 1.0

*/
use SilverStripe\Dev\SapphireTest;


class FeedbackValidTest extends SapphireTest
{

    //Test max characters
    public function testExceedLimit()
    {
        $FirstName = "LessthantwintyName";
        $maxChars =20;
        
        $this->assertFalse(FeedbackValid::ExceedLimit($FirstName,$maxChars));
    }

    //Test for only [A-Za-z]
    public function testOnlyChars()
    {
        $FirstName = "OnlyCharsName";
      
        $this->assertFalse(FeedbackValid::OnlyChars($FirstName));
    }
}