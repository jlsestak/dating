<?php

/*model/data-layer.php
*/

class DataLayer
{
    private $_dbh;

    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    function saveMember()
    {
        $member = $_SESSION['memberRank'];


        //Define the query
        $sql = "INSERT INTO member(fname, lname, age,gender, phone, email, state, seeking,bio, premium,interests) 
	            VALUES (:fname, :lname, :age, :gender , :phone , :email ,:states ,:seeking ,:bio,:premium, :interests)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);
        $hello = "hello";


        if($_SESSION['premiumMember']) {
            $interests = $member->getIndoorInterests() . ", " . $member->getOutdoorInterests();
            $num = 1;
        }else {
            $interests = "";
            $num = 0;
        }
        //Bind the parameters
        $statement->bindParam(':fname', $member->getFname(), PDO::PARAM_STR);
        $statement->bindParam(':lname', $member->getLname(), PDO::PARAM_STR);
        $statement->bindParam(':age', $member->getAge(), PDO::PARAM_INT);
        $statement->bindParam(':gender', $member->getGender(), PDO::PARAM_STR);
        $statement->bindParam(':phone', $member->getPhone(), PDO::PARAM_STR);
        $statement->bindParam(':email', $member->getEmail(), PDO::PARAM_STR);
        $statement->bindParam(':states', $member->getState(), PDO::PARAM_STR);
        $statement->bindParam(':seeking', $member->getSeeking(), PDO::PARAM_STR);
        $statement->bindParam(':bio', $member->getBio(), PDO::PARAM_STR);
        $statement->bindParam(':premium', $num, PDO::PARAM_INT);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        /*
        $name = "Hello";
        $num = 0;
        $statement->bindParam(':fname', $name, PDO::PARAM_STR);
        $statement->bindParam(':lname', $name, PDO::PARAM_STR);
        $statement->bindParam(':age', $num, PDO::PARAM_INT);
        $statement->bindParam(':gender', $name, PDO::PARAM_STR);
        $statement->bindParam(':phone', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $name, PDO::PARAM_STR);
        $statement->bindParam(':states', $name, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $name, PDO::PARAM_STR);
        $statement->bindParam(':bio', $name, PDO::PARAM_STR);
    //    if($premium) {
            $statement->bindParam(':premium', $num, PDO::PARAM_INT);
            $statement->bindParam(':interests',$name, PDO::PARAM_STR);
        }
     */


        //Execute
        $statement->execute();
       // echo '<p>Kangaroo added!</p>';
        //$id = $this->_dbh->lastInsertId();

    }

    /**
     * getGender returns an array of genders
     * @return string[]
     */
    function getGender()
    {
        return array ("female", "male");
    }

    /**
     * getIndoorInterests() returns an array of indoor interests
     * @return string[]
     */
    function getIndoorInterests()
    {
        return array("tv","puzzles","movies","reading","cooking","playing cards","board games", "video games");
    }

    /**
     * getOutdoorInterest returns an array of outdoor interests
     * @return string[]
     */
    function getOutdoorInterests()
    {
        return array("hiking", "walking", "biking","climbing","swimming","camping", "skiing","rafting");
    }

}
