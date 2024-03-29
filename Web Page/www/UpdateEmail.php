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
    <?php include "NavMod.php"; ?>

    <!-- Begin page content -->
    <div class="container">

        <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <fieldset>
                <div class="row">
                    <div class="col-md-8 col-sm-8" style="border: 1px solid #ddd; border-radius: 3px 3px 3px 3px;padding: 14px 26px 26px;box-shadow: 4px 4px 1px #c4c4c4;">
                        <legend>Update your address</legend>
                        <div class="col-md-12 col-sm-12">
                            <div class="control-group">
                                <label class="control-label" for="email">Email:</label>
                                <div class="controls">
                                    <input id="email" name="email" type="email" placeholder="Email" class="input-xlarge form-control">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="control-group">
                                <label class="control-label" for="emailConfirm">Confirm Email:</label>
                                <div class="controls">
                                    <input id="emailConfirm" name="emailConfirm" type="email" placeholder="Email Confirmation" class="input-xlarge form-control" style="margin-bottom: 30px">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg raised" value="Submit">
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <a href="UserProfile.php?id=<?php echo $_SESSION['userid']; ?>""><button type="button" class="btn btn-primary btn-lg raised">Cancel</button></a>
                        </div>
                    </div>

                    <!-- Help side div-->
                    <div class="col-md-4 col-sm-4" col-xs-4>
                        <p>Welcome to the email update page.</p><br>
                        <p></p>

                    </div>

                </div>
                </div>

            </fieldset>
        </form>

        
        <div id="push"></div>
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
