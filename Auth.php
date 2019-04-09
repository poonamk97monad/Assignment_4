<?php

include_once 'Connection.php';

class Auth extends Connection
{
    /**
     * User login
     * @return void
     */
    public function loginUser() {
        $strEmailId   = $_POST['userid'];
        $strPassword  = $_POST['password'];
        // To select email and password with mysqli database
        $arrStrQuery    = "select * from userdata where email = '$strEmailId' and password = '$strPassword'";
        $arrObjResult   = mysqli_query($this->objConnection,$arrStrQuery);
        if(mysqli_num_rows($arrObjResult) > 0) {
            session_start();
            $_SESSION['userid']   = $strEmailId;
            $_SESSION['password'] = $strPassword;
            header("location:home.php");
        }
        else {
            header('Location: index.php?msg=' . urlencode('User_Not_Valid'));
        }
    }
    /**
     * User logout function
     * @return void
     */
    public function logoutUser() {
        session_start();
        unset($_SESSION['userid']);
        header('Location: index.php');
    }

}

