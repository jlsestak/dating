<?php
/*model/validatate.php
Contains validation for Jessica's dating site

*/

class Validate
{

    private $_dataLayer;

    function __construct()
    {
        $this->_dataLayer = new DataLayer();
    }

    /**
     * validName() Checks to see if user's names are alphabetic and are not empty
     * @param String $name
     * @return bool
     */
    function validName($name)
    {
        return !empty($name) && ctype_alpha($name);

    }


    /**
     * validAge Checks to see if the user's age is not empty, between 18 and 118 and is numeric
     * @param Integer $age
     * @return bool
     */
    function validAge($age)
    {
        return !empty($age) && $age >= 18 && $age <= 118 && is_numeric($age);
    }


    /**
     *validPhone() Checks to see if the user has a valid phone (xxx-xxx-xxxx)
     * @param String $phone
     * @return bool
     */
    function validPhone($phone)
    {
        return !empty($phone) && preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone);
    }


    /**
     * validEmail() Checks to see if the user has a valid email
     * @param String $email
     * @return bool
     */
    function validEmail($email)
    {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * validOutdoor checks to see if the outdoor interest values are valid
     * @param array $outdoor
     * @return bool
     */
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

    /**
     * validIndoor() checks to see if the indoor interest values are valid
     * @param array $indoor
     * @return bool
     */
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
}