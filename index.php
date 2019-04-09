<?php
//Login & New form should not shown after login
include('Connection.php');

session_start();

if($_SESSION['userid']) {
    header("location:home.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Assignment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
            });

            function validLoginForm() {

                var objUserId   = document.forms["loginform"]["userid"];
                var objPassword = document.forms["loginform"]["password"];
                if ("" == objUserId.value){
                    window.alert("Please enter userid ");
                    objUserId.focus();
                    return false;
                }
                if ("" == objPassword.value){
                    window.alert("Please enter password");
                    objPassword.focus();
                    return false;
                }
            }

            $(function() {
                $('#user_type').change(function() {
                    var data= $(this).val();
                    if(data == "student") {
                        $("#teacher").hide();
                        $("#student").show();
                    }
                    if(data == "teacher") {
                        $("#student").hide();
                        $("#teacher").show();
                    }
                    if(data == null) {
                        $("#student").hide();
                        $("#teacher").hide();
                    }
                });

                $('#user_type')
                    .val('two')
                    .trigger('change');
            });

            function validRegisterForm() {
                var strFirstName  = document.forms["registerform"]["fname"];
                var strLastName   = document.forms["registerform"]["lname"];
                var strEmail      = document.forms["registerform"]["email"];
                var intPhone      = document.forms["registerform"]["phone"];
                var strAbout      = document.forms["registerform"]["about"];
                var strPassword   = document.forms["registerform"]["password"];
                var strRePassword = document.forms["registerform"]["repassword"];
                var strUserType   = document.forms["registerform"]["usertype"];
                 if ("" == strFirstName.value) {
                     window.alert("Please enter your First name.");
                     strFirstName.focus();
                     return false;
                 }
                 if ("" == strLastName.value) {
                      window.alert("Please enter your last name.");
                     strLastName.focus();
                      return false;
                 }
                  //validate email
                 if ("" == strEmail.value) {
                     window.alert("Please enter a valid e-mail address.");
                     strEmail.focus();
                     return false;
                 }
                 if (strEmail.value.indexOf("@", 0) < 0) {
                      window.alert("Please enter a valid e-mail address.");
                   strEmail.focus();
                      return false;
                 }
                 if (strEmail.value.indexOf(".", 0) < 0) {
                      window.alert("Please enter a valid e-mail address.");
                      strEmail.focus();
                    return false;
                 }
                 if ("" == intPhone.value) {
                     window.alert("Please enter your telephone number.");
                     intPhone.focus();
                    return false;
                 }
                 if ("" == strAbout.value) {
                  window.alert("Please enter something about you ");
                    strAbout.focus();
                    return false;
                 }
                 if("" == strPassword.value) {
                    window.alert("please enter your password");
                    strPassword.focus();
                  return false;
                 }
                 if("" == strRePassword.value) {
                    window.alert("please confirm your password");
                    strRePassword.focus();
                    return false;
                 }
                 if(strPassword.value != strRePassword.value) {
                    window.alert("please check your password");
                    strRePassword.focus();
                    return false;
                 }
                 if ("" == strUserType.value) {
                    window.alert("Please select usertype ");
                    strUserType.focus();
                    return false;
                 }
            }
        </script>
    </head>
    <body class="body-back text-light">
        <!--navigation bar-->
        <nav class="navbar navbar-expand-md bg-secondary navbar-dark ">
            <a class="navbar-brand" href="#">
                <img src="img/monad.png" class="rounded-circle"  alt="logo" style="width:40px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#register" >Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#login" data-toggle="tooltip" title="If you not regitser user first regitser then login"><span class="glyphicon glyphicon-log-in"></span>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Registetion form modal-->
        <div class="modal fade text-light foropacity" id="register" role="dialog">
            <div class="modal-dialog modal-lg ">
                <!-- Modal content-->
                <div class="modal-content bg-secondary text-light">
                    <div class="modal-header">
                        <h4 class="modal-title text">User Register</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!--login form-->
                        <form method="post" action="check.php" onsubmit="return validRegisterForm()" name="registerform" id="registerform">
                            <div class="form-group">
                                <label>First name:</label>
                                <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>" placeholder="your 1st name" id="fname" >
                                <span class = "error"><?php echo $strFirstNameErr;?></span>
                            </div>
                            <div class="form-group">
                                <label>Last name :</label>
                                <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>"  placeholder="your last name" id="lname">
                                <span class = "error"><?php echo $strLastNameErr;?></span>
                            </div>
                            <div class="form-group">
                                <label>Email_id:</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"  placeholder="someone@gmail.com" id="email">
                            </div>
                            <div class="form-group">
                                <label>Moblie_no.:</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" placeholder="99999888888" id="phone">
                                <span class = "error"><?php echo $strPhoneErr;?></span>
                            </div>
                            <div class="form-group">
                                <label>About:</label>
                                <textarea name="about"  class="form-control" id="about" placeholder="write something about you"></textarea>
                                <span class = "error"></span>
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="min lenght 8 " id="password">
                                <span class = "error"><?php echo $strPasswordErr;?></span>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password:</label>
                                <input type="password" class="form-control" name="repassword" value="<?php echo $repassword; ?>" placeholder="re-enter password" id="repassword">
                                <span class = "error"><?php echo $strPasswordErr;?></span>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label>User Type:</label>
                                    <select id="user_type" class="form-control " name="usertype" >
                                        <option value="student" id="stu_id" class="stu_id" >Student</option>
                                        <option value="teacher" id="tea_id" class="tea_id" >Teacher</option>
                                    </select>
                                </div>
                            </div>
                            <!--teacher-->
                            <div  id="teacher" class="teacher">
                                <div class="form-group">
                                    <label>Deparment_name:</label>
                                        <input type="text" class="form-control" name="deparment_name" value=NUll  placeholder="department_name" ><br><br>
                                    <label>Are you HOD:</label>
                                        <input type="radio" name="is_hod" value="yes"> YES
                                        <input type="radio" name="is_hod" value="no" checked> NO<br>
                                    <label>Teaching Subjects:</label>
                                        <input type="text" class="form-control" name="teaching_subjects" value=NUll placeholder="teaching_subjects" >
                                </div>
                            </div>
                            <!--student-->
                            <div  id="student" class="student">
                                <div class="form-group">
                                    <label>Class Name:</label>
                                        <input type="text" class="form-control" name="class_name" value=NUll placeholder="class_name" >
                                    <label>Are you MONITOR:</label>
                                        <input type="radio" name="is_monitor" value="yes" > YES
                                        <input type="radio" name="is_monitor" value="no" checked> NO<br>
                                    <label  >Studying Subjects:</label>
                                        <input type="text" class="form-control" name="studying_subjects" value=NUll placeholder="studying_subjects" >
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success"  type="submit" value="SAVE" id="regi"  name="save"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!--login form modal-->
        <div class="modal fade text-light foropacity" id="login" role="dialog">
            <div class="modal-dialog modal-sm">
                <!-- Modal content-->
                <div class="modal-content  bg-dark">
                    <div class="modal-header">
                        <h4 class="modal-title text">User LogIn</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!--login form-->
                        <form action="check.php" method="post" onsubmit="return validLoginForm()" name="loginform" autocomplete="off">
                            <div class="form-group">
                                <label>Email_id:</label>

                                <input type="text" class="form-control" name="userid" value="" placeholder="abc@mail.com"  >
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <i class='fas fa-lock'></i>
                                <input type="password" class="form-control" name="password"  placeholder="*********" >
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login" value="login" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--carousel-->
        <div id="demo" class="carousel slide mt-5" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" ></li>
                <li data-target="#demo" data-slide-to="1" ></li>
                <li data-target="#demo" data-slide-to="2" ></li>
                <li data-target="#demo" data-slide-to="3"></li>
            </ul>
            <!-- The slideshow -->
            <div class="carousel-inner text-center">
                <div class="carousel-item active">
                    <img src="img/img6.png" alt="Los Angeles" class="img-fluid" width="1100" height="500">
                </div>
                <div class="carousel-item ">
                    <img src="img/img1.png" alt="Los Angeles" class="img-fluid" width="1250" height="400">
                </div>
                <div class="carousel-item">
                    <img src="img/img4.jpg" alt="Chicago" class="img-fluid" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="img/img5.jpg" alt="New York" class="img-fluid" width="1100" height="500">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
        <div id="band" class="container text-center mt-5">
            <h3>If You Can Dream It You Can Achieve It..</h3>
            <p><em>......</em></p>
            <p>“When you are able to shift your inner awareness to how you can serve others, and when you make this the central focus of your life, you will then be in a position to know true miracles in your progress toward prosperity.”.</p>
            <br>
        </div>
        <!--contact-->
        <div id="contact" class="container mt-5 mp-5">
            <h3 class="text-center">CONTACT</h3>
            <div class="row mt-5 mp-5">
                <div class="col-md-4">
                    <p> Drop a note.</p>
                    <p><i class='fas fa-map-marker-alt'></i> Pune, India</p>
                    <p><i class='fas fa-phone'></i>Phone: +00 1515151515</p>
                    <p><i class="fa fa-envelope"></i> Email: mail@mail.com</p>
                </div>
                <div class="col-md-8">
                    <form action="check.php" method="post">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                            </div>
                        </div>
                        <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
                        <br>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button class="btn btn-light btn-outline-primary pull-right" type="submit" name="contact" >Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--footer-->
        <div class="jumbotron text-center bg-secondary mb-0" >
            <p>Footer</p>
        </div>
    </body>
</html>
