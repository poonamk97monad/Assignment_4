<?php

require 'init.php';
class UserData extends Connection
{

    /**
     * To get list of all fields for user
     * @return array - $arrStrAllFields
     */
    public function getAllFields() {
        $arrStrAllFields = array('fname','lname','email','phone','about','usertype');
        return $arrStrAllFields;

    }

    /**
     * To get list of fields
     * @return array - $arrStrFields
     */
    public function getFields() {
        return [];
    }
}



