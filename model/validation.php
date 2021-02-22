<?php
/*model/validatate.php
Contains validation for Jessica's dating site

*/

function validName($name)
{
    $name = trim($name);
    return !empty($name) && ctype_alpha($name);

}

function validAge()
{

}

function validPhone()
{

}

function validEmail()
{

}

function validOutdoor()
{

}

function validIndoor()
{

}