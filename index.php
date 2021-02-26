<?php
/*
 * Jessica Sestak
 * 02/09/2021
 * This is the controller page for Jessica's Online Dating service for people who like cats
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//require files
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validation.php');



//create an instance of the base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//default root
$f3->route('GET /', function () {

    $view = new Template();
    echo $view->render('views/home.html');
}
);
//order route
$f3->route('GET|POST /personal', function ($f3) {
    $f3->set('genders', getGender());
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $age = trim($_POST['age']);
        $gender = $_POST['genders'];
        $phone = $_POST['phone'];

        //Save first name to session if valid
        if (validName($fname)) {
            $_SESSION['fname'] = $_POST['fname'];
        }
        else if($fname ==""){
            $f3->set('errors["fname"]', "First Name cannot be blank");
        }
        else {
            $f3->set('errors["fname"]', "First Name must contain only alphabetic characters");
        }
        //Save last name to session if valid
        if (validName($lname)) {
            $_SESSION['lname'] = $_POST['lname'];
        }
        else if($lname == ""){

            $f3->set('errors["lname"]', "Last Name cannot be blank");
        }
        else {
            $f3->set('errors["lname"]', "Last name must contain only alphabetic characters");
        }

        //Save age if valid
        if (validAge($age)) {
            $_SESSION['age'] = $_POST['age'];
        }
        else if(!is_numeric($age)) {
            $f3->set('errors["age"]', "Please enter a numeric value for age");
        }
        else if($age == "") {
            $f3->set('errors["age"]', "Age cannot be blank");
        }
        else if($age < 18){

            $f3->set('errors["age"]', "Come back when you are an adult");
        }
        else {
            $f3->set('errors["age"]', "Congratulations on your milestone, 
            but we are not an inclusive dating site. Sorry!");
        }
        //save gender to session
        if (isset($_POST['genders'])) {
            $_SESSION['gender'] = $_POST['genders'];
        }

        //save phone to session
        if (validPhone($phone)) {
            $_SESSION['phone'] = $_POST['phone'];
        }
        else if($phone == "") {
            $f3->set('errors["phone"]', "Phone number cannot be blank");
        }
        else {
            $f3->set('errors["phone"]', "Please put a valid phone number (XXX-XXX-XXXX)");
        }

        //If there are no errors, redirect to /profile
        if(empty($f3->get('errors'))) {
            $f3->reroute('/profile');
        }

    }
    $f3 ->set('userFirstName', isset($fname) ? $fname : "");
    $f3 ->set('userLastName', isset($lname) ? $lname : "");
    $f3 ->set('userAge', isset($age) ? $age : "");
    $f3 ->set('userGender', isset($gender) ? $gender : "");
    $f3 ->set('userPhone', isset($phone) ? $phone : "");
    //echo "Order Page";
    $view = new Template();
    echo $view->render('views/personal.html');

});

//order route
$f3->route('GET|POST /profile', function ($f3) {
    $f3->set('seekingGender', getGender());
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $seeking = $_POST['seeking'];
        $biography = $_POST['biography'];
        $state = $_POST['state'];

        //save email to session
    if (validEmail($email)) {
        $_SESSION['email'] = $_POST['email'];
    }
    else if($email == "") {
        $f3->set('errors["email"]', "Email cannot be blank");
    }
    else {
        $f3->set('errors["email"]', "Please give a valid email");
    }
    //save state to session
    if (isset($_POST['state'])) {
        $_SESSION['state'] = $_POST['state'];
    }
    //save seeking to session
    if (isset($_POST['seeking'])) {
        $_SESSION['seeking'] = $_POST['seeking'];
    }
    //save biography to session
    if (isset($_POST['biography'])) {
        $_SESSION['biography'] = $_POST['biography'];
    }
        //If there are no errors, redirect to /profile
        if(empty($f3->get('errors'))) {
            $f3->reroute('/interests');
        }
    }
    $f3 ->set('userEmail', isset($email) ? $email : "");
    $f3 ->set('userSeeking', isset($seeking) ? $seeking : "");
    $f3 ->set('userState', isset($state) ? $state : "");
    $f3 ->set('userBio', isset($biography) ? $biography : "");
    //display profile view
    $view = new Template();
    echo $view->render('views/profile.html');

});

//interests route
$f3->route('GET|POST /interests', function ($f3) {


    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //
        $indoorInterests = $_POST['indoorInterests'];
        $outdoorInterests = $_POST['outdoorInterests'];
        if(isset($_POST['indoorInterests'])) {
            if (validIndoor($indoorInterests)) {
                $indoorInterests = implode(", ", $indoorInterests);
                $_SESSION['indoorInterests'] = $indoorInterests;
            } else {
                $f3->set('errors["indoors"]', "Please select a valid indoor interest");
            }
        }
        if(isset($outdoorInterests)) {
            if(validOutdoor($outdoorInterests)) {
                $outdoorInterests = implode(", ",$outdoorInterests);
                $_SESSION['outdoorInterests'] = $outdoorInterests;
            }
            else {
                $f3->set('errors["outdoors"]', "Please select a valid outdoor interest");
            }
        }

        //If there are no errors, redirect to /profile
        if(empty($f3->get('errors'))) {
            $f3->reroute('/summary');
        }

    }
    $f3->set('indoor', getIndoorInterests());
    $f3->set('outdoor', getOutdoorInterests());
    //display interests view
    $view = new Template();
    echo $view->render('views/interests.html');

});

$f3->route('GET /summary', function () {


    //display summary view
    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();

});

//run fat free
$f3->run();