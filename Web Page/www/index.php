<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <meta charset="utf-8">
    <title>Task Master</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">

        /* Sticky footer styles
        -------------------------------------------------- */

        html,
        body {
            height: 100%;
            /* The html and body elements cannot have any padding or margin. */
        }

        /* Wrapper for page content to push down footer */
        #wrap {
            min-height: 100%;
            height: auto !important;
            height: 100%;
            /* Negative indent footer by it's height */
            margin: 0 auto -60px;
        }

        /* Set the fixed height of the footer here */
        #push,
        #footer {
            height: 60px;
        }
        #footer {
            background-color: #222;
        }

        /* Lastly, apply responsive CSS fixes as necessary */
        @media (max-width: 767px) {
            #footer {
                margin-left: -20px;
                margin-right: -20px;
                padding-left: 20px;
                padding-right: 20px;
            }
        }

    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="../assets/ico/favicon.png">
</head>

<body>


<!-- Part 1: Wrap all page content here -->
<div id="wrap">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Task Master</a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="CreateTask.php">Create Task</a></li>
                    <li><a href="#">View Tasks</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="UserRegistration.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <!--
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    -->

                    <li>
                         <?php include "loginMod.php"; ?>  
                    </li>

                </ul>
            </div>
        </div>

        <!-- Search bar-->
        <div class="container">
            <div class="row">

                <!--
                <div class="col-md-1">
                    <select title="search in">
                        <option>Food</option>
                        <option>Car</option>
                        <option>Lawn</option>
                    </select>
                </div>
                -->
                <div id="custom-search-input">

                    <div class="input-group col-md-12">

                        <div class="input-group-btn input-group-btn-static">
                            <button type="button" class="btn btn-default" data-toggle="dropdown">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu" role="menu" id="drop">
                                <li><a href="#">Select Category</a></li>
                            </ul>
                        </div>

                        <input type="text" class="  search-query form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                    </div>
                </div>
            </div>
        </div>

    </nav>

    <!-- Begin page content -->
    <div class="container">
        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <div class="item active">
                    <img src="images/tutoring.jpeg" alt="tutoring" width="460" height="345">
                    <div class="carousel-caption">
                    </div>
                </div>

                <div class="item">
                    <img src="images/baking.jpg" alt="baking" width="460" height="345">
                    <div class="carousel-caption">
                    </div>
                </div>

                <div class="item">
                    <img src="images/carwork.jpg" alt="CarWork" width="460" height="345">
                    <div class="carousel-caption">
                    </div>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <div id="push"></div>
    </div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <button type="button" class="btn btn-primary btn-lg raised" onclick="CreateTask.html">Create Task</button>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
            <button type="button" class="btn btn-primary btn-lg raised">Find Task</button>
        </div>
    </div>



    <div id="push"></div>
</div>

<div id="footer">
    <div class="container">
        <p class="muted credit" style="color: white">COP 4331 Project 2</p>
    </div>
</div>


</body>
</html>
