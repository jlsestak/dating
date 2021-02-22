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

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $age = trim($_POST['age']);
        $gender = $_POST['gender'];
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


        //save age to session
        if (isset($_POST['age'])) {
            $_SESSION['age'] = $_POST['age'];
        }
        //save gender to session
        if (isset($_POST['gender'])) {
            $_SESSION['gender'] = $_POST['gender'];
        }
        //save phone to session
        if (isset($_POST['phone'])) {
            $_SESSION['phone'] = $_POST['phone'];
        }

        //If there are no errors, redirect to /profile
        if(empty($f3->get('errors'))) {
            $f3->reroute('/profile');
        }

    }
    $f3 ->set('userFirstName', isset($fname) ? $fname : "");
    $f3 ->set('userLastName', isset($lname) ? $lname : "");
    //echo "Order Page";
    $view = new Template();
    echo $view->render('views/personal.html');

});

//order route
$f3->route('GET|POST /profile', function () {

    //display profile view
    $view = new Template();
    echo $view->render('views/profile.html');

});

//interests route
$f3->route('GET|POST /interests', function ($f3) {

    $f3->set('indoor', getIndoorInterests());
    $f3->set('outdoor', getOutdoorInterests());
    //save email to session
    if (isset($_POST['email'])) {
        $_SESSION['email'] = $_POST['email'];
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

    //display interests view
    $view = new Template();
    echo $view->render('views/interests.html');

});

$f3->route('GET|POST /summary', function () {

    //save interests to session
    if (isset($_POST['interests'])) {
        $interest = $_POST['interests'];
        $_SESSION['interests'] = implode(", ", $interest);

    }

    //display summary view
    $view = new Template();
    echo $view->render('views/summary.html');

});

//run fat free
$f3->run();