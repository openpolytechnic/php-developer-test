# PHP backend skill test

## Overview

### Application
The Feedback App allows us to collect feedback. Here is the requirement for the app.

* Anyone can submit feedback using this form.
* Anyone can see the number of submissions so far based on the date.
* Logged-in User can search, view and export the feedback from the Admin Interface.

## Requirements
* PHP 8+
* Mysql
* Apache 2.4+
* Composer 2+
* A github account

## Installation

<mark>Note: You need to fork this repository. See [Submiting your work?](#submiting-your-work)</mark>

1. Create a database in your Mysql server
2. Clone your forked repository
3. Run composer install and create .env file
```sh
composer install
cp .env.example .env
```
4. Update the database settings in .env file
5. Run database build to setup initial data
```sh
.\vendor\bin\sake dev/build "flush=1"
```
5. Run the Dev server and access the site [http://localhost:5050](http://localhost:5050)
```sh 
php -S localhost:5050 -t public/
```
You can access the admin interface using the [http://localhost:5050/admin](http://localhost:5050/admin) with the following credentials:

Credentials:
* Username: admin
* Password: password

## Instructions

### Tasks
1. <strong>New Feedback Page Type:</strong> Create a new page type called "Feedback" Page. A new page of the "Feedback" type should be created under Home and accessed from the main menu.
2. <strong>Add Feedback Form To Feedback Page:</strong> Add form to the Feedback Page which saves user entries to the database on submission. Form fields are:
    * First Name
    * Last Name
    * Email
    * Message
3. <strong>Feedback Form Validations:</strong> Add the following validation using backend code to the form
    * First Name - Should be a required field, have less than or equal to 20 characters, and only allow [A-Z] of both lower & upper cases
    * Last Name - Should be required field, only have less than or equal to 20 characters and only allow [A-Z] of both lower & upper cases
    * Email - Should be a required field and valid email format
    * Message - Should be required field and only have less than or equal to 255
4. <strong>Unit Test For Feedback Form Validations:</strong> Add PHPUnit test for the validation code in task 4.
5. <strong>Admin Access to Feedback Submissions:</strong> Logged in user should be able to access submissions from the Admin interface with the following features:
    * Submission should be sorted by First Name, Email, and submitted date.
    * Submission should be searchable using First Name, Last Name, and Email.
    * Submission can be exported as a CSV file which should have First Name, Last Name, Email, Message, and Submitted Date as columns.
6. <strong>Stats On Feedback Submissions:</strong> Stats on the number of submissions by date for the last 10 days should be shown below the form in the front end. E.g.
    * 10 - 11 Jan 2023
    * 5 - 10 Jan 2023

### Sample Feedback Page
![FeedbackPage](/app/images/SampleFeedbackForm.png?raw=true "FeedbackPage")

### What we are looking for?
1. All task is completed in a week, Time start as soon as you received access to the code.
2. How well you are using existing SilverStripe features to add this new functionality?
3. How well you are following SilverStripe coding standards?
3. Code is structured properly and easy to read. Simple clear code comments in the code will be helpful.
4. Separate your <b>commits by task</b> and use the following format for your commit messages: <b>{task heading - Bold text in task} - {time taken in hours} e.g. 'New Feedback Page Type - 3:20hr'</b>.
5. Having a simple UI for the feedback form(Please use the simple theme which comes with this repo). UI work will be only considered as a bonus.


### How to submit your work?

1. ##### First you need to [fork this repository](https://docs.github.com/en/get-started/quickstart/fork-a-repo).
2. ##### Then clone your fork locally.
3. ##### Install the app locally. See the [installation guide](#Installation).
4. ##### Once you've completed your work, you can submit a [pull request to the remote repository](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests/creating-a-pull-request-from-a-fork).
5. ##### Send an email back to us with the PR link.

## What next

We will review the pull request and contact you regarding the next step. 
