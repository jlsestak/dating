<?php

/*model/data-layer.php
*/

class DataLayer
{
    /**
     * getGender returns an array of genders
     * @return string[]
     */
    function getGender() {
        return array ("female", "male");
    }

    /**
     * getIndoorInterests() returns an array of indoor interests
     * @return string[]
     */
    function getIndoorInterests() {
        return array("tv","puzzles","movies","reading","cooking","playing cards","board games", "video games");
    }

    /**
     * getOutdoorInterest returns an array of outdoor interests
     * @return string[]
     */
    function getOutdoorInterests() {
        return array("hiking", "walking", "biking","climbing","swimming","camping", "skiing","rafting");
    }

}
