<?php

include_once 'Connection.php';

class Validation extends Connection
{
    /**
     * To check empty fileds
     * @param  $arrStrData
     * @param  $strFields
     * @return String
     */
    public function checkEmptyFields($arrStrData, $strFields) {

        $strMessage = null;
        foreach ($strFields as $strValue) {
            if (empty($arrStrData[$strValue])) {
                $strMessage .= "$strValue field empty <br />";
            }
        }
        return $strMessage;
    }

    /**
     * To check valid phone number
     * @param  $intPhone
     * @return Boolean
     */
    public function isPhoneValid($intPhone) {

        if (preg_match("/^[0-9]+$/", $intPhone)) {
            return true;
        }
        return false;
    }

    /**
     * To check both password are same
     * @param  $strPassword
     * @param  $strRePassword
     * @return Boolean
     */
    public function isPasswordCorrect($strPassword,$strRePassword) {

        if ($strPassword === $strRePassword) {
            return true;
        }
        return false;
    }

    /**
     * To check valid emailId
     * @param  $strEmail
     * @return Boolean
     */
    public function isEmailValid($strEmail) {

        if (filter_var($strEmail, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

}

