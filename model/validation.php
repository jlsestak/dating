<?php
/*model/validatate.php
Contains validation for Jessica's dating site

*/
//require data-layer
require_once('data-layer.php');

//Checks to see if user's names are alphabetic and are not empty
function validName($name)
{
    return !empty($name) && ctype_alpha($name);

}

//Checks to see if the user's age is not empty, between 18 and 118 and is numeric
function validAge($age)
{
    return !empty($age) && $age >= 18 && $age <= 118 && is_numeric($age);
}

//Checks to see if the user has a valid phone (xxx-xxx-xxxx)
function validPhone($phone)
{
    return !empty($phone) && preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone);
}

//checks to see if the email is valid
function validEmail($email)
{
    return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
}

//checks to see if the outdoor interest values are valid
function validOutdoor($outdoor)
{
    $validOutdoor = getOutdoorInterests();
    foreach ($outdoor as $outdoorInterests) {

        if (!in_array($outdoorInterests, $validOutdoor)) {
            return false;
        }
    }
    return true;
}

//checks to see if the indoor interest values are valid
function validIndoor($indoor)
{
    $validIndoor = getIndoorInterests();
    foreach ($indoor as $indoorInterests) {
        if (!in_array($indoorInterests, $validIndoor)) {
            return false;
        }
    }
    return true;
}