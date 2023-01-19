<?php

namespace {

    use SilverStripe\CMS\Controllers\RootURLController;
    use SilverStripe\CMS\Model\SiteTree;
    use SilverStripe\ORM\DB;
    use SilverStripe\SiteConfig\SiteConfig;
    use SilverStripe\Versioned\Versioned;

    class Page extends SiteTree
    {
        private static $db = [];

        private static $has_one = [];

        public function requireDefaultRecords()
        {
            parent::requireDefaultRecords();
            $defaultHomepage = RootURLController::config()->get('default_homepage_link');
            $homePage = SiteTree::get_by_link($defaultHomepage);
            if ($homePage) {
                $homePage->Title = _t(__CLASS__ . '.DEFAULTHOMETITLE', 'Instructions');
                $homePage->Content = _t(__CLASS__ . '.DEFAULTHOMECONTENT', <<<HTML
<h3>Tasks</h3>
<ol>
    <li><strong>New Feedback Page Type:</strong> Create a new page type called "Feedback" Page. A new page of the "Feedback" type should be created under Home and accessed from the main menu.</li>
    <li><strong>Add Feedback Form To Feedback Page:</strong> Add form to the Feedback Page which saves user entries to the database on submission. Form fields are:
        <ul>
            <li>First Name</li>
            <li>Last Name</li>
            <li>Email</li>
            <li>Message</li>
        </ul>
    </li>
    <li><strong>Feedback Form Validations:</strong> Add the following validation using backend code to the form
        <ul>
            <li>First Name - Should be a required field, have less than or equal to 20 characters, and only allow [A-Z] of both lower &amp; upper cases</li>
            <li>Last Name - Should be required field, only have less than or equal to 20 characters and only allow [A-Z] of both lower &amp; upper cases</li>
            <li>Email - Should be a required field and valid email format</li>
            <li>Message - Should be required field and only have less than or equal to 255</li>
        </ul>
    </li>
    <li><strong>Unit Test For Feedback Form Validations:</strong> Add PHPUnit test for the validation code in task 4.</li>
    <li><strong>Admin Access to Feedback Submissions:</strong> Logged in user should be able to access submissions from the Admin interface with the following features:
        <ul>
            <li>Submission should be sorted by First Name, Email, and submitted date.</li>
            <li>Submission should be searchable using First Name, Last Name, and Email.</li>
            <li>Submission can be exported as a CSV file which should have First Name, Last Name, Email, Message, and Submitted Date as columns.</li>
        </ul>
    </li>
    <li><strong>Stats On Feedback Submissions:</strong> Stats on the number of submissions by date for the last 10 days should be shown below the form in the front end. E.g.
        <ul>
            <li>10 - 11 Jan 2023</li>
            <li>5 - 10 Jan 2023</li>
        </ul>
    </li>
</ol>

<h3>What we are looking for?</h3>
<ol>
    <li>All task is completed in a week, Time start as soon as you received access to the code.</li>
    <li>How well you are using existing SilverStripe features to add this new functionality?</li>
    <li>How well you are following SilverStripe coding standards?</li>
    <li>Code is structured properly and easy to read. Simple clear code comments in the code will be helpful.</li>
    <li>Separate your <b>commits by task</b> and use the following format for your commit messages: <b>{task heading - Bold text in task} - {time taken in hours} e.g. 'New Feedback Page Type - 3:20hr'</b></li>
    <li>Having a simple UI for the feedback form(Please use the simple theme which comes with this repo). UI work will be only considered as a bonus.</li>
</ol>

<h3>How to submit your work?</h3>
<ol>
    <li>
        <h5>First you need to <a href="https://docs.github.com/en/get-started/quickstart/fork-a-repo" target="_blank">fork this repository</a>.</h5>
    </li>
    <li>
        <h5>Then clone your fork locally.</h5>
    </li>
    <li>
        <h5>Install the app locally. See the <a href="https://github.com/openpolytechnic/php-developer-test#Installation" target="_blank">installation guide</a>.</h5>
    </li>
    <li>
        <h5>Once you've completed your work, you can submit a <a href="https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request-from-a-fork" target="_blank">pull request to the remote repository</a>.</h5>
    </li>
    <li>
        <h5>Send an email back to us with the PR link.</h5>
    </li>
</ol>
HTML
                );
                $homePage->write();
                $homePage->copyVersionToStage(Versioned::DRAFT, Versioned::LIVE);
                $homePage->flushCache();
                DB::alteration_message('Home content updated', 'updated');
            }

            $siteConfig = SiteConfig::current_site_config();
            if ($siteConfig && ($siteConfig->Title === "Your Site Name"
                    || $siteConfig->Tagline === "your tagline here")) {
                $siteConfig->Title = _t(self::class . '.SITENAMEDEFAULT', "Open Polytechnic");
                $siteConfig->Tagline = _t(self::class . '.TAGLINEDEFAULT', "PHP Developer Code Test");
                $siteConfig->write();
                $siteConfig->flushCache();
                DB::alteration_message('Site config updated', 'updated');

            }
        }
    }
}
