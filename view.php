<?php

    include('Connection.php');
    include('User.php');
    require 'init.php';
    require "predis/autoload.php";

    session_start();
    if(!isset($_SESSION['userid'])) {
        # redirect to the login page
        header('Location: index.php?msg=' . urlencode('Login first.'));
        exit();
    }
        $objUser = new User();
        //fetching data
        $arrResult = $objUser->getData();

?>
<?php

    if(isset($_GET['fav'])) {
        $strFavorite  = $_GET['fav'];
        $intId        = $_GET['id'];
        $strEmail     = $_GET['email'];
        (new User())->setFavorite($intId);

    }

?>
<?php

if(isset($_GET['search'])) {

    $strSearch   = $_GET['search'];
    $strUserType = $_GET['user_type'];
    $strSortType = $_GET['sort'];
    $arrMixParams  = [
        'index' => 'userdata',
        'type'  => 'user',
        'body' => [
                'query' => [
                        'bool' => [
                                'must' => ['match' => [ 'fname' => $strSearch ]],
                              /*'must' => ['match' => [ 'lname' => $search ]],
                                'must' => ['match' => [ 'fname' => $search ]],*/
                                'filter' => ['term' => [ 'usertype' => $strUserType ]]
                        ]
                ],
               "sort"=> [
                  [ "_id"=> "asc" ]
               ]
        ]
        ];
    $arrMixSql = $client->search($arrMixParams);
    /*echo '<pre>',print_r($query),'</pre>';*/
}

if($arrMixSql['hits'] >= 1) {
    $arrSearchResults = $arrMixSql['hits']['hits'];
    /* print_r($searchResults);*/
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
            $(document).ready(function() {
                $('[data-toggle="popover"]').popover();
            });

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
                        <a class="nav-link" href="home.php" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="view.php">View Data</a>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <form action="check.php" method="get">
                    </form>
                    <h4 class="right">
                    <form action="view.php" method="get">
                        <input type="text" name="search">
                        <input type="submit" value="Search">
                        <select id="user_type"  name="user_type" >
                            <option value="both" >Filter</option>
                            <option value="student" >Student</option>
                            <option value="teacher" >Teacher</option>
                        </select>

                    </form>
                    </h4>
                    <table  class=" table table-dark table-striped table-sm">
                        <tr>
                            <table class="table table-dark table-striped table-hover table-sm">
                                <thead>
                                <tr>
                                    <div class="text-light">

                                    </div>
                                    <th> ID</th>
                                    <th> First Name</th>
                                    <th> Last Name</th>
                                    <th> Emai_ID</th>
                                    <th> User Type</th>
                                </tr>
                                </thead>
                                <?php
                                if(isset($arrSearchResults)) {
                                    foreach ($arrSearchResults as $strSearch) {
                                        echo '<tbody>';
                                        echo '<tr>';
                                        echo '<td>' . $strSearch['_source']['id'] . '</td>';
                                        echo '<td>' . $strSearch['_source']['fname'] . '</td>';
                                        echo '<td>' . $strSearch['_source']['lname'] . '</td>';
                                        echo '<td>' . $strSearch['_source']['email'] . '</td>';
                                        echo '<td>' . $strSearch['_source']['usertype'] . '</td>';
                                        echo '</tr>';
                                        echo '</tbody>';
                                    }
                                }
                                ?>
                            </table>
                        </tr>
                    </table>
                    <br><br><hr>
                    <h6 class="text-center right">All user last login details </h6>

                    <div class="card right">
                        <div class="card-body">
                            <h6 class="card-title pname">
                                <?php
                                Predis\Autoloader::register();
                                $redis = new Predis\Client();
                                $arrUserLogin = $redis->lrange("lastlogin" ,0,50);
                                foreach ($arrUserLogin as $strUser) {
                                    echo $strUser.'<br>';
                                }
                                echo '<hr>';
                               ?>
                            </h6>
                        </div>
                    </div>
                    <!--<h3>Favrites Users</h3>-->
                    <?php
                    /*$arrMixList = $redis->SMEMBERS('favorite:user');
                    $intLength = count($arrMixList);
                    for($x = 0; $x < $intLength; $x++) {
                        echo $arrMixList[$x];
                        echo "<br><hr>";
                    }*/
                    ?>

                </div>
                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-center view-title ">
                                <h3>All Users Entry</h3>
                            </div>
                        </div>
                    </div>

                    <table  class=" table table-dark table-striped table-sm">
                        <tr>
                            <table class="table table-dark table-striped table-hover table-sm">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> First Name</th>
                                    <th> Last Name</th>
                                    <th> Emai_ID</th>
                                    <th> Mobile</th>
                                    <th> User Type</th>
                                    <th> Favorites</th>
                                    <th colspan="2"> Action</th>
                                </tr>
                                </thead>
                                <?php
                                foreach ($arrResult as $key => $strResult) {
                                    $boolIsFavoritted = (new User())->isFavoritted($strResult["id"]);
                                    $strUnFovrites    = 'UnFovrites';
                                    $strFovrites      = 'Fovrites';
                                    echo'<tbody>';
                                    echo'<tr>';
                                    echo'<td>'.$strResult['id'].'</td>';
                                    echo'<td>'.$strResult['fname'].'</td>';
                                    echo'<td>'.$strResult['lname'].'</td>';
                                    echo'<td>'.$strResult['email'].'</td>';
                                    echo'<td>'.$strResult['phone'].'</td>';
                                    echo'<td>'.$strResult['usertype'].'</td>';
                                    echo'<td>';
                                    if($boolIsFavoritted == 1) {
                                        echo 'YES';
                                    }
                                    else {
                                        echo 'NO';
                                    }
                                    echo '</td>';
                                    echo'<td><a name="delete" class="btn btn-danger" href="check.php?idd='.$strResult["id"].'"> Delete</a></td>';
                                    echo'<td><a class="btn btn-info" href="update.php?id='.$strResult["id"].'&fname='.$strResult["fname"].'&lname='.$strResult["lname"].'&email='.$strResult["email"].'&phone='.$strResult["phone"].'&about='.$strResult["about"].'&usertype='.$strResult["usertype"].'&class_name='.$strResult["class_name"].'&is_monitor='.$strResult["is_monitor"].'&studying_subjects='.$strResult["studying_subjects"].'&deparment_name='.$strResult["deparment_name"].'&is_hod='.$strResult["is_hod"].'&teaching_subjects='.$strResult["teaching_subjects"].'">Edit</a></td>';
                                    echo'<td><form action="view.php" method="get">';

                                    if($boolIsFavoritted == 1) {
                                        echo '<a name="fav" class="btn btn-success" href="view.php?fav='.$strUnFovrites.'&id='.$strResult["id"].'&email='.$strResult["email"].'" value="UnFavorites">UnFavorites</a>';
                                    }

                                    else {
                                        echo '<a name="fav" class="btn btn-success" href="view.php?fav='.$strFovrites.'&id='.$strResult["id"].'&email='.$strResult["email"].'" value="Favorites"> Favorites </a>';
                                    }
                                    echo'</td> </form>';
                                    echo'</tr>';
                                    echo'</tbody>';
                                }
                                ?>
                            </table>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!--footer-->
        <div class=" text-center bg-secondary footer" >
            <p>Footer</p>
        </div>
    </body>
</html>
