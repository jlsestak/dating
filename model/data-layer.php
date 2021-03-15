<?php

/**
 * @author Jessica Sestak
 * @Version 1.0
 * model/data-layer.php
 * dataLayer provides access to and from the database as well as data for the Dating site
*/

class DataLayer
{
    private $_dbh;

    /**
     * DataLayer constructor.
     * @param $dbh
     */
    function __construct($dbh)
    {
        $this->_dbh = $dbh;
    }

    /**
     * insertMember inserts the members information into the database
     */
    function insertMember()
    {
        //get the member information
        $member = $_SESSION['memberRank'];

        //Define the query
        $sql = "INSERT INTO member(fname, lname, age,gender, phone, email, state, seeking,bio, premium,interests) 
	            VALUES (:fname, :lname, :age, :gender , :phone , :email ,:states ,:seeking ,:bio,:premium, :interests)";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //check to see if a premiumMember and set the interests and the premiumCheck accordingly
        if ($_SESSION['premiumMember']) {
            $interests = $member->getIndoorInterests() . ", " . $member->getOutdoorInterests();
            $premiumCheck = 1;
        } else {
            $interests = "";
            $premiumCheck = 0;
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
        $statement->bindParam(':premium', $premiumCheck, PDO::PARAM_INT);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);

        //Execute
        $statement->execute();

    }

    /**
     * getMembers gets the members information from the database and orders by last name
     * @return associative array
     */
    function getMembers()
    {
        //Define the query
        $sql = "SELECT * FROM member ORDER BY lname";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * getMember($member_id) gets a single member from the database using their member id
     * @param $member_id
     * @return associative array
     */
    function getMember($member_id)
    {
        //Define the query
        $sql = "SELECT * FROM member WHERE member_id = $member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * getInterests($member_id) gets the interests from the member based on their member id
     * @param $member_id
     * @return associative array
     */
    function getInterests($member_id)
    {
        //Define the query
        $sql = "SELECT interests FROM member WHERE member_id = $member_id";

        //Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        //Execute
        $statement->execute();

        //Get the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * getGender returns an array of genders
     * @return string[]
     */
    function getGender()
    {
        return array("female", "male");
    }

    /**
     * getIndoorInterests() returns an array of indoor interests
     * @return string[]
     */
    function getIndoorInterests()
    {
        return array("tv", "puzzles", "movies", "reading", "cooking", "playing cards", "board games", "video games");
    }

    /**
     * getOutdoorInterest returns an array of outdoor interests
     * @return string[]
     */
    function getOutdoorInterests()
    {
        return array("hiking", "walking", "biking", "climbing", "swimming", "camping", "skiing", "rafting");
    }

}
