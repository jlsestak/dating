<?php

class Member
{
    //fields for member
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;

    /**
     * Member constructor.
     * @param $_fname String
     * @param $_lname String
     * @param $_age int
     * @param $_gender String
     * @param $_phone String
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
    }

    /**
     * @return String first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * @param String $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return String last Name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * @param String $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return int age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return String gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /**
     * @param String $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return String phone
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param String $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return String email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param String email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return String state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * @param String $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return String seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * @param String $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return String biography
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * @param String $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }


}