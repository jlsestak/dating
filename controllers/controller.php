<?php

class Controller
{
    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    /** Display home page */
    function home()
    {
        //Display a view
        $view = new Template();
        echo $view->render('views/home.html');
    }

    /*Display personal page */
    function personal()
    {
        global $validator;

        //send the array of genders to the personal view
        $this->_f3->set('genders', getGender());

        //Check to see if the user has submitted the personal page
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //get user input from form
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
                $this->_f3->set('errors["fname"]', "First Name cannot be blank");
            }
            else {
                $this->_f3->set('errors["fname"]', "First Name must contain only alphabetic characters");
            }

            //Save last name to session if valid
            if ($validator->validName($lname)) {
                $_SESSION['lname'] = $_POST['lname'];
            }
            else if($lname == ""){

                $this->_f3->set('errors["lname"]', "Last Name cannot be blank");
            }
            else {
                $this->_f3->set('errors["lname"]', "Last name must contain only alphabetic characters");
            }

            //Save age if valid
            if ($validator->validAge($age)) {
                $_SESSION['age'] = $_POST['age'];
            }
            else if(!is_numeric($age)) {
                $this->_f3->set('errors["age"]', "Please enter a numeric value for age");
            }
            else if($age == "") {
                $this->_f3->set('errors["age"]', "Age cannot be blank");
            }
            else if($age < 18){

                $this->_f3->set('errors["age"]', "Come back when you are an adult");
            }
            else {
                $this->_f3->set('errors["age"]', "Congratulations on your milestone, 
            but we are not an inclusive dating site. Sorry!");
            }

            //save gender to session
            if (isset($this->_f3->$_POST['genders'])) {
                $_SESSION['gender'] = $_POST['genders'];
            }

            //save phone to session
            if ($validator->validPhone($phone)) {
                $_SESSION['phone'] = $_POST['phone'];
            }
            else if($phone == "") {
                $this->_f3->set('errors["phone"]', "Phone number cannot be blank");
            }
            else {
                $this->_f3->set('errors["phone"]', "Please put a valid phone number (XXX-XXX-XXXX)");
            }

            //If there are no errors, redirect to /profile
            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/profile');
            }

        }

        //Make the elements in the form sticky
        $this->_f3->set('userFirstName', isset($fname) ? $fname : "");
        $this->_f3->set('userLastName', isset($lname) ? $lname : "");
        $this->_f3->set('userAge', isset($age) ? $age : "");
        $this->_f3->set('userGender', isset($gender) ? $gender : "");
        $this->_f3->set('userPhone', isset($phone) ? $phone : "");

        $view = new Template();
        echo $view->render('views/personal.html');
    }

    function profile()
    {
        global $datalayer;
        //send the gender array to the profile page
        $this->_f3->set('seekingGender', $datalayer->getGender());

        //check to see if the user has submitted the profile page
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //get the user input from the profile form
            $email = $_POST['email'];
            $seeking = $_POST['seeking'];
            $biography = $_POST['biography'];
            $state = $_POST['state'];

            //save email to session
            if (validEmail($email)) {
                $_SESSION['email'] = $_POST['email'];
            }
            else if($email == "") {
                $this->_f3->set('errors["email"]', "Email cannot be blank");
            }
            else {
                $this->_f3->set('errors["email"]', "Please give a valid email");
            }

            //save state to session
            if (isset($this->_f3->$_POST['state'])) {
                $_SESSION['state'] = $_POST['state'];
            }
            //save seeking to session
            if (isset($this->_f3->$_POST['seeking'])) {
                $_SESSION['seeking'] = $_POST['seeking'];
            }
            //save biography to session
            if (isset($this->_f3->$_POST['biography'])) {
                $_SESSION['biography'] = $_POST['biography'];
            }
            //If there are no errors, redirect to /profile
            if(empty($this->_f3->set('errors'))) {
                $this->_f3->reroute('/interests');
            }
        }

        //Make the profile form sticky
        $this->_f3->set('userEmail', isset($email) ? $email : "");
        $this->_f3->set('userSeeking', isset($seeking) ? $seeking : "");
        $this->_f3->set('userState', isset($state) ? $state : "");
        $this->_f3->set('userBio', isset($biography) ? $biography : "");

        //display profile view
        $view = new Template();
        echo $view->render('views/profile.html');
    }

    function interests()
    {
        global $validator;
        global $datalayer;
        //Check to see if the user has submitted the interest page
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            //get the user input for interests form
            $indoorInterests = $_POST['indoorInterests'];
            $outdoorInterests = $_POST['outdoorInterests'];

            //Check to see if Indoor interests are set and if they are check if they are valid
            if(isset($_POST['indoorInterests'])) {
                if ($validator->validIndoor($indoorInterests)) {
                    $indoorInterests = implode(", ", $indoorInterests);
                    $_SESSION['indoorInterests'] = $indoorInterests;
                } else {
                    $this->_f3->set('errors["indoors"]', "Please select a valid indoor interest");
                }
            }

            //Check to see if Outdoor interests are set and if they are check if they are valid
            if(isset($outdoorInterests)) {
                if($validator->validOutdoor($outdoorInterests)) {
                    $outdoorInterests = implode(", ",$outdoorInterests);
                    $_SESSION['outdoorInterests'] = $outdoorInterests;
                }
                else {
                    $this->_f3->set('errors["outdoors"]', "Please select a valid outdoor interest");
                }
            }

            //If there are no errors, redirect to /profile
            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('/summary');
            }
        }

        //send the interest arrays to the interest form
        $this->_f3->set('indoor', getIndoorInterests());
        $this->_f3->set('outdoor', getOutdoorInterests());

        //display interests view
        $view = new Template();
        echo $view->render('views/interests.html');
    }

    function summary()
    {
        //display summary view
        $view = new Template();
        echo $view->render('views/summary.html');
        session_destroy();
    }
}