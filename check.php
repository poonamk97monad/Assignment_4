<?php

  include ('Connection.php');
  include ('Auth.php');
  include ('User.php');
  include ('Validation.php');
  include ('UserData.php');
  include ('Student.php');
  include ('Teacher.php');
  require 'init.php';
  require "predis/autoload.php";

  $objAuth       = new Auth();
  $objUser       = new User();
  $objValidation = new Validation();
  $objStudent    = new Student();
  $objTeacher    = new Teacher();

  if(isset($_POST["save"])) {
      $strMessage = $objValidation->checkEmptyFields($_POST, array('fname', 'lname', 'email', 'phone', 'about', 'password', 'repassword', 'usertype'));
      $strCheckPhone = $objValidation->isPhoneValid($_POST['phone']);
      $strCheckEmail = $objValidation->isEmailValid($_POST['email']);
      $strCheckPassword = $objValidation->isPasswordCorrect($_POST['password'], $_POST['repassword']);
      if ($strMessage != null) {
          echo $strMessage;
          //link to the previous page
          echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$strCheckPhone) {
          echo 'Please provide proper phone no..';
          //link to the previous page
          echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$strCheckEmail) {
          echo 'Please provide proper email.';
          //link to the previous page
          echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
      } elseif (!$strCheckPassword) {
          echo 'Please check your password';
          //link to the previous page
          echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
      } else {
          // To insert with mysqli database
          $objRegister = $objUser->registerUser();

          $result = $objUser->getData();

          foreach ($result as $key => $res) {
              $intid       = $res['id'];
              $strFname    = $res['fname'];
              $strLname    = $res['lname'];
              $strEmail    = $res['email'];
              $intPhone    = $res['phone'];
              $strAbout    = $res['about'];
              $strUserType = $res['usertype'];

              $indexed = $client->index([
                  'index' => 'userdata',
                  'type'  => 'user',
                  'id'    => $intid,
                  'body'  => [
                      'id'       => $intid,
                      'fname'    => $strFname,
                      'lname'    => $strLname,
                      'email'    => $strEmail,
                      'phone'    => $intPhone,
                      'about'    => $strAbout,
                      'usertype' => $strUserType,
                  ]
              ]);
               /*if ($indexed) {
                    print_r($indexed);
               }*/
          }
      }
  }

  else {
    if(isset($_POST["login"])) {
        /** @var object $obj */
        $objLogin = $objAuth->loginUser();

        Predis\Autoloader::register();
        $redis       = new Predis\Client();
        $strUserId   = $_POST['userid'];
        $strPassword = $_POST['password'];
        $redis->connect('127.0.0.1', 6379);
        echo "Last Login";
        echo "<br><hr><br>";
        //store data in redis list
        $redis->lpush("lastlogin", $strUserId, date("M,d,Y h:i:s A"));

    }

    }


?>
<?php

   if(isset($_POST["logout"])) {

       $objLogout = $objAuth->logoutUser();
   }

?>
<?php

if(isset($_POST["contact"])) {

    $objContact = $objUser->contactUser();
}

?>
<?php

    if(isset($_POST["update"])) {

         $strMessage        = $objValidation->checkEmptyFields($_POST, array('fname','lname','email','phone','about','usertype'));
         $strCheckPhone     = $objValidation->isPhoneValid($_POST['phone']);
         $strCheckEmail     = $objValidation->isEmailValid($_POST['email']);
         $strUserType       = $_POST['usertype'];
        if($strMessage != null) {
            header('Location: update.php?fname='.$_POST["fname"].'&lname='.$_POST["lname"].'&email='.$_POST["email"].'&phone='.$_POST["phone"].'&about='.$_POST["about"].'&strError=' . urlencode('All fileds are requred'));
        }
        elseif (!$strCheckEmail) {
            header('Location: update.php?fname='.$_POST["fname"].'&lname='.$_POST["lname"].'&email='.$_POST["email"].'&phone='.$_POST["phone"].'&about='.$_POST["about"].'&strEmailError=' . urlencode('Please provide proper Email Id'));
        }
        elseif (!$strCheckPhone) {
            header('Location: update.php?fname='.$_POST["fname"].'&lname='.$_POST["lname"].'&email='.$_POST["email"].'&phone='.$_POST["phone"].'&about='.$_POST["about"].'&strPhoneError=' . urlencode('Please provide proper phone no..'));
        }
        else {
            switch ($strUserType) {
                case 'Student':
                    $arrMixAllFields = $objStudent->updateFields();
                    $result = $objUser->getData();

                    foreach ($result as $key => $res) {
                        $intid       = $res['id'];
                        $strFname    = $res['fname'];
                        $strLname    = $res['lname'];
                        $strEmail    = $res['email'];
                        $intPhone    = $res['phone'];
                        $strAbout    = $res['about'];
                        $strUserType = $res['usertype'];

                        $indexed = $client->index([
                            'index' => 'userdata',
                            'type'  => 'user',
                            'id'    => $intid,
                            'body'  => [
                                'id'       => $intid,
                                'fname'    => $strFname,
                                'lname'    => $strLname,
                                'email'    => $strEmail,
                                'phone'    => $intPhone,
                                'about'    => $strAbout,
                                'usertype' => $strUserType,
                            ]
                        ]);
                        /*if ($indexed) {
                             print_r($indexed);
                        }*/
                    }

                    break;
                case 'Teacher':
                    $arrMixAllFields = $objTeacher->updateFields();
                    $result = $objUser->getData();

                    foreach ($result as $key => $res) {
                        $intid       = $res['id'];
                        $strFname    = $res['fname'];
                        $strLname    = $res['lname'];
                        $strEmail    = $res['email'];
                        $intPhone    = $res['phone'];
                        $strAbout    = $res['about'];
                        $strUserType = $res['usertype'];

                        $indexed = $client->index([
                            'index' => 'userdata',
                            'type'  => 'user',
                            'id'    => $intid,
                            'body'  => [
                                'id'       => $intid,
                                'fname'    => $strFname,
                                'lname'    => $strLname,
                                'email'    => $strEmail,
                                'phone'    => $intPhone,
                                'about'    => $strAbout,
                                'usertype' => $strUserType,
                            ]
                        ]);
                        /*if ($indexed) {
                             print_r($indexed);
                        }*/
                    }

                    break;
                default:
                    echo "Select User Type";die;
                    break;
            }

        }

    }

?>
<?php

if(isset($_GET['idd'])) {

    $objDelete = $objUser->deleteUser();
}
?>

