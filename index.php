<?php
/*
 * Jessica Sestak
 * 01/24/2021
 * This is the controller page for Jessica's Online Dating service for people who like cats
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

//Start a session
session_start();

//require the autoload file
require_once('vendor/autoload.php');

//create an instance of the base class
$f3 = Base::instance();
$f3->set('DEBUG', 3);

//default root
$f3->route('GET /', function(){

    $view = new Template();
    echo $view->render('views/home.html');
}
);
//order route
$f3->route('GET /personal', function(){
    //echo "Order Page";
    $view = new Template();
    echo $view->render('views/personal.html');

});

//order route
$f3->route('POST /profile', function(){
    if(isset($_POST['fname'])){
        $_SESSION['fname'] = $_POST['fname'];
    }
    if(isset($_POST['lname'])){
        $_SESSION['lname'] = $_POST['lname'];
    }
    if(isset($_POST['age'])){
        $_SESSION['age'] = $_POST['age'];
    }
    if(isset($_POST['gender'])){
        $_SESSION['gender'] = $_POST['gender'];
    }
    if(isset($_POST['phone'])){
        $_SESSION['phone'] = $_POST['phone'];
    }
    $view = new Template();
    echo $view->render('views/profile.html');

});

//order2 route
$f3->route('POST /interests', function(){
    if(isset($_POST['email'])){
        $_SESSION['email'] = $_POST['email'];
    }
    if(isset($_POST['state'])){
        $_SESSION['state'] = $_POST['state'];
    }
    if(isset($_POST['seeking'])) {
        $_SESSION['seeking'] = $_POST['seeking'];
    }
    if(isset($_POST['biography'])){
        $_SESSION['biography'] = $_POST['biography'];
    }

    //display a view
    $view = new Template();
    echo $view->render('views/interests.html');

});

$f3->route('POST /summary', function(){
    if(isset($_POST['interests'])){
        $_SESSION['interests'] = $_POST['interests'];
    }

    //display a view
    $view = new Template();
    echo $view->render('views/summary.html');

});

//run fat free
$f3->run();