<?php

include_once 'Connection.php';

class Teacher extends UserData
{
    /**
     * To get list of Teacher fields for user
     * @return array - $arrStrFields
     */
    public function getFields() {
        $arrStrFields = array('deparment_name','is_hod','teaching_subjects');
        return $arrStrFields;
    }
    /**
     * To update All fields
     * @return void
     */
    public function updateFields() {

        $intId           = $_POST['id'];
        $arrStrAllFields = $this->getAllFields();
        $arrStrFields    = $this->getFields();

        $strQueryBuild = "";
        foreach ($arrStrAllFields as $intCounter => $strField) {
            if(isset($_POST[$strField])) {
                $strQueryBuild .= $strField.'="'.$_POST[$strField].'"';
                if(isset($arrStrAllFields[$intCounter])) {
                    $strQueryBuild = $strQueryBuild . ',';
                }
            }
        }
        foreach ($arrStrFields as $intCounter => $strField) {

            if(isset($_POST[$strField])) {
                $strQueryBuild .= $strField.'="'.$_POST[$strField].'"';

                if(isset($arrStrFields[$intCounter+1])) {
                    $strQueryBuild = $strQueryBuild . ',';
                }

            }
        }
        $strSql = "update users SET $strQueryBuild where id = '$intId'";
        $arrObjResult = mysqli_query($this->objConnection, $strSql);
        if (!$arrObjResult) {
            die("record not update");
        } else {
            echo ("Update successfully");
            header('Location: update.php?strSuccess=' . urlencode('Success! Update successfully'));
        }
    }
}

