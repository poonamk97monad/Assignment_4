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
<html lang="en">
    <head>
        <title>Assignment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('[data-toggle="popover"]').popover();
            });
        </script>

    </head>
    <body>
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
                        <a class="nav-link active" href="home.php" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View Data</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">My Account
                            <span class="caret"></span></a>
                        <ul class="nav-item dropdown-menu">
                            <li><form action="check.php" method="post"><input class="btn form-control" type="submit" name="logout" value="Logout"></li>
                        </ul>
                    </li>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid" >
            <div class="row">
                <div class=" col-4 bg-dark text-light">
                    <h2 class="text-center right">My Profile</h2>
                    <div class="card right card-right" >
                        <img src="img/user.png" class="card-img" alt="Avatar" >
                        <div class="card-body">
                            <h4 class="card-title pname text-center"><?php echo $_SESSION["userid"]; ?></h4>
                            <br><br>
                            <a href="#" class="btn btn-primary">See Profile</a>

                        </div>
                    </div>
                </div>
                <div class=" col-8 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-center">
                                <img class="card-img-top" src="img/back.jpeg" alt="Card image">
                                <div class="card-img-overlay col-sm-12">
                                    <h4 class="card-title">Golden Thoughts by Great People</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card-header">
                            <p class="person-name"><strong>Dr.A.P.Kalam</strong></p>
                            <a href="#demo1" data-toggle="collapse" >
                                <img src="img/kalam.jpg" class="rounded-circle person" alt="Random Name" width="180" height="180" data-toggle="tooltip" title="click me" data-placement="bottom">
                            </a>
                            <div id="demo1" class="collapse thoughts">
                                <p>Do Not Read success stories, You will get only message. Read failure stories, You will get some idea to get success!" -Dr.A.P.Kalam</p>
                            </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card-header">
                                <p class="person-name"><strong>Mother Teresa</strong></p>
                                <a href="#demo2" data-toggle="collapse" >
                                    <img src="img/Teresa.jpg" class="rounded-circle person" alt="Random Name" width="180" height="180" data-toggle="tooltip" title="click me" data-placement="bottom">
                                </a>
                                <div id="demo2" class="collapse thoughts">
                                    <p>“Kind words can be short and easy to speak, but their echoes are truly endless.”</p>
                                </div>
                                </div>
                            </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="card-header">
                            <p class="person-name"><strong>Swami Vivekanand</strong></p>
                            <a href="#demo3" data-toggle="collapse" >
                                <img src="img/Swami.jpg" class="rounded-circle person" alt="Random Name" width="180" height="180" data-toggle="tooltip" title="click me" data-placement="bottom">
                            </a>
                            <div id="demo3" class="collapse thoughts">
                                <p>“Do one thing at a Time, and while doing it put your whole Soul into it to the exclusion of all else.”</p>
                            </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card-header">
                                <p class="person-name"><strong>R.Tata</strong></p>
                                <a href="#demo4" data-toggle="collapse" >
                                    <img src="img/Tata.jpg" class="rounded-circle person" alt="Random Name" width="180" height="180" data-toggle="tooltip" title="click me" data-placement="bottom">
                                </a>
                                <div id="demo4" class="collapse thoughts" >
                                    <p>“I don't believe in taking right decisions. I take decisions and then make them right.”</p>
                                </div>
                            </div>
                        </div>
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
