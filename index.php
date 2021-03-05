<?php
/*
 * Jessica Sestak
 * 02/09/2021
 * This is the controller page for Jessica's Online Dating service for people who like cats
 */

ini_set('display_errors', 1);
error_reporting(E_ALL);



//require files
require_once('vendor/autoload.php');
//Start a session
session_start();



//Instatiate my classes
$f3 = Base::instance();
$datalayer = new DataLayer();
$validator = new Validate();
$controller = new Controller($f3);

$f3->set('DEBUG', 3);

//default root
$f3->route('GET /', function () {
   global $controller;
   $controller->home();
}
);

//personal route
$f3->route('GET|POST /personal', function ($f3) {
    global $controller;
    $controller->personal();

});

//profile route
$f3->route('GET|POST /profile', function ($f3) {
    global $controller;
    $controller->profile();

});

//interests route
$f3->route('GET|POST /interests', function ($f3) {
    global $controller;
    $controller->interests();

});

//summary route
$f3->route('GET /summary', function () {

    global $controller;
    $controller->summary();

});

//run fat free
$f3->run();