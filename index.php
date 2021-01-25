<?php
/*
 * Jessica Sestak
 * 01/24/2021
 * This is the controller page for Jessica's Online Dating service for people who like cats
 */

ini_set('display_errors',1);
error_reporting(E_ALL);

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

//run fat free
$f3->run();