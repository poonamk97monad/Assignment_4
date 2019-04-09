<?php

include('Connection.php');
session_start();
  if(!isset($_SESSION['userid'])) {
      # redirect to the login page
      header('Location: index.php?msg=' . urlencode('Login first.'));
      exit();
  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Assignment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="home.css">
        <script>

            $(function() {
                $('#contact_usertype').change(function() {
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
                $('#contact_usertype')
                    .val('two')
                    .trigger('change');
            });

            $(document).ready(function() {
                $('#contact_fname').on('input', function() {
                    var input=$(this);
                    var is_fname=input.val();
                    if(is_fname){input.removeClass("invalid").addClass("valid");}
                    else{input.removeClass("valid").addClass("invalid");}
                });

                $('#contact_lname').on('input', function() {
                    var input=$(this);
                    var is_lname=input.val();
                    if(is_lname){input.removeClass("invalid").addClass("valid");}
                    else{input.removeClass("valid").addClass("invalid");}
                });

                $('#contact_email').on('input', function() {
                    var input=$(this);
                    var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                    var is_email=re.test(input.val());
                    if(is_email){input.removeClass("invalid").addClass("valid");}
                    else{input.removeClass("valid").addClass("invalid");}
                });

                $('#contact_phone').on('input', function() {
                    var input=$(this);
                    var re = /^[0-9]+$/;
                    var is_phone=re.test(input.val());
                    if(is_phone){input.removeClass("invalid").addClass("valid");}
                    else{input.removeClass("valid").addClass("invalid");}
                });

                $('#contact_about').on('input', function() {
                    var input=$(this);
                    var is_about=input.val();
                    if(is_about){input.removeClass("invalid").addClass("valid");}
                    else{input.removeClass("valid").addClass("invalid");}
                });

                $('#contact_usertype').on('input', function() {
                    var input=$(this);
                    var is_usertype=input.val();
                    if(is_usertype){input.removeClass("invalid").addClass("valid");}
                    else{input.removeClass("valid").addClass("invalid");}
                });

            });
        </script>
    </head>
    <body class="bg-dark text-light">
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
                        <a class="nav-link" href="home.php" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php" >View Data</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">My Account
                            <span class="caret"></span></a>
                        <ul class="nav-item dropdown-menu">
                            <li><form action="check.php" method="post"><input class="btn form-control" type="submit" name="logout" value="Logout"></form></li>
                        </ul>
                        </li>
                    </li>
                </ul>
            </div>
        </nav>
        <!--body-->
        <div class="container-fluid" >
            <div class="row">
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-center view-title ">
                              <h3>Update Details</h3>
                            </div>
                        </div>
                    </div>
                    <div class="formtext">
                        <div>
                            <div class="text-danger font-weight-bolder ">
                                <?php echo $_GET['strError'];?>
                            </div>
                            <div class="text-success font-weight-bolder ">
                                <h4><?php echo $_GET['strSuccess'];?></h4>
                            </div>
                            <form method="post" action="check.php" id="contact" >
                              <input type="text" value="<?php echo $_GET['id']?>" class="uphidden" name="id">
                              <div class="form-group">
                                  <label for="fname">First name:<em class="required">*</em></label>
                                  <input type="text" class="form-control is-valid" name="fname" value="<?php echo $_GET['fname'];?>" placeholder="your 1st name" id="contact_fname" >
                                  <span class="error">This field is required</span>
                              </div>
                              <div class="form-group">
                                  <label for="lname">Last name :<em class="required">*</em></label>
                                  <input type="text" class="form-control is-valid" name="lname" value="<?php echo $_GET['lname']; ?>"  placeholder="your last name" id="contact_lname" >
                                  <span class="error">This field is required</span>
                              </div>
                              <div class="form-group">
                                  <label for="email">Email_id:<em class="required">*</em></label>
                                  <input type="text" class="form-control is-valid" name="email" value="<?php echo $_GET['email']; ?>"  placeholder="someone@gmail.com" id="contact_email">
                                  <span class="error">A valid email address is required</span>
                                  <div class="text-danger font-weight-bolder ">
                                      <?php echo $_GET['strEmailError'];?>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="phone">Moblie_no.:</label>
                                  <input type="text" class="form-control is-valid" name="phone" value="<?php echo $_GET['phone']; ?>" placeholder="99999888888" id="contact_phone">
                                  <span class="error">A valid phone address is required</span>
                                  <div class="text-danger font-weight-bolder ">
                                      <?php echo $_GET['strPhoneError'];?>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="about">About:<em class="required">*</em></label>
                                  <textarea name="about" class="form-control is-valid" rows="3" cols="57" id="contact_about" placeholder="write something about you">
                                  <?php echo $_GET['about']; ?></textarea>
                                  <span class="error">This field is required</span>
                              </div>
                              <div class="form-group uphidden">
                                  <label>Password:</label>
                                  <input type="password" class="form-control is-valid" name="password" value="" placeholder="min lenght 8 "  id="password">
                              </div>
                              <div class="form-group uphidden">
                                  <label>Confirm Password:</label>
                                  <input type="password" class="form-control is-valid" name="repassword" value="" placeholder="re-enter password"  id="repassword">
                              </div>
                              <div class="form-group ">
                                  <label>User Type:</em></label>
                                  <select id="contact_usertype" name="usertype" class="usertype">
                                      <option value="student" id="stu_id" class="stu_id" >Student</option>
                                      <option value="teacher" id="tea_id" class="tea_id" >Teacher</option>
                                  </select>

                              </div>
                                <span class="error">Select User Type</span>
                                <!--teacher-->
                              <div  id="teacher" class="teacher">
                                  <label>Deparment_name:</label>
                                  <input type="text" class="form-control is-valid" name="deparment_name" value=NUll  placeholder="department_name" ><br><br>
                                  <label>Are you HOD:</label>
                                  <input type="radio" name="is_hod" value="yes"> YES
                                  <input type="radio" name="is_hod" value="no" checked> NO<br><br>
                                  <label>Teaching Subjects:</label>
                                  <input type="text" class="form-control is-valid" name="teaching_subjects" value=NUll placeholder="teaching_subjects" >
                              </div>
                              <!--student-->
                              <div  id="student" class="student">
                                  <label>Class Name:</em></label>
                                  <input type="text" class="form-control is-valid" name="class_name" value=NUll placeholder="class_name" ><br><br>
                                  <label>Are you MONITOR:</label>
                                  <input type="radio" name="is_monitor" value="yes" > YES
                                  <input type="radio" name="is_monitor" value="no" checked> NO<br><br>
                                  <label>Studying Subjects:</label>
                                  <input type="text" class="form-control is-valid" name="studying_subjects" value=NUll placeholder="studying_subjects" >
                              </div>
                              <div class="form-group">
                                  <!--<input type="submit" class="btn btn-success" id="update" value="UPDATE" name="update"/>-->
                                  <div id="contact_submit">
                                      <button type="submit" class="btn btn-success" name="update">Update</button>
                                  </div>
                              </div>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="bg-dark text-light">
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
                                    <img src="img/img6.png" class="img-fluid" alt="Los Angeles" width="1100" height="500">
                                </div>
                                <div class="carousel-item ">
                                    <img src="img/img1.png" class="img-fluid" alt="Los Angeles" width="1100" height="500">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/img4.jpg" class="img-fluid" alt="Chicago" width="1100" height="500">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/img5.jpg" class="img-fluid" alt="New York" width="1100" height="500">
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
                    </div>
                    <div id="band" class="container text-center mt-5">
                        <h3>If You Can Dream It You Can Achieve It..</h3>
                        <p><em>......</em></p>
                        <p>“When you are able to shift your inner awareness to how you can serve others, and when you make this the central focus of your life, you will then be in a position to know true miracles in your progress toward prosperity.”.</p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <!--footer-->
        <div class="jumbotron text-center bg-secondary" >
            <p>Footer</p>
        </div>
    </body>
</html>
