<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--font source-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Resources for box design -->
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/user_css.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <link rel="stylesheet" href="lib/jquery.raty.css">
    <script src="vendor/jquery.js"></script>
    <script src="lib/jquery.raty.js"></script>
    <script src="javascripts/labs.js" type="text/javascript"></script>

    <meta charset="utf-8">
    <title>Task Creation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>

        /* Sticky footer styles
        -------------------------------------------------- */

        html,
        body {
            height: 100% !important;
            /* The html and body elements cannot have any padding or margin. */
        }

        /* Wrapper for page content to push down footer */
        #wrap {
            min-height: 100% !important;
            height: auto !important;
            height: 100% !important;
            /* Negative indent footer by it's height */
            margin: -90px auto 90px !important;
        }

        /* Set the fixed height of the footer here */
        #push,
        #footer {
            height: 60px !important;
        }
        #footer {
            background-color: #222 !important;
        }

        /* Lastly, apply responsive CSS fixes as necessary */
        @media (max-width: 767px) {
            #footer {
                margin-left: -20px !important;
                margin-right: -20px !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
        }

        @import url('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');

        .date-form { margin: 10px; }
        label.cont        rol-label span { cursor: pointer; }

        tr:hover {
            cursor: pointer;
        }

    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->



</head>

<body>


<!-- Part 1: Wrap all page content here -->
<div id="wrap">

    <!-- Fixed navbar -->
    <?php include "NavMod.php"; ?>

    <!-- Begin page content -->
    <div class="container">
        <div class="row-fluid grid-set">
            <div class="span6">
                <div class="box">
                    <div class="header">
                        <h4>
                            <!-- The number in parenthesis is the number of new unread messages -->
                            Inbox(2)
                        </h4>
                    </div>

                    <div class="content">

                        <table class="table table-condensed margin-reset" style="overflow-y: scroll">
                            <tbody>

                            <!-- link stores user id of both users that will be messaging -->
                            <tr onclick="window.document.location='Messaging.php?UserID1=&&UserID2=';">
                                <td>
                                    <img src="images/UserStock.png" style="height:75px;width:auto">
                                </td>
                                <td>
                                    <span class="userNames">Bob</span>
                                    <br>
                                        <span class="status">
                                           First few characters of message...
                                        </span>
                                </td>
                            </tr>
                            <tr onclick="window.document.location='Messaging.php?UserID1=&&UserID2=';">
                                <td>
                                    <img src="images/UserStock.png" style="height:75px;width:auto">
                                </td>
                                <td>
                                    <span class="userNames">Sally</span>
                                    <br>
                                        <span class="status">
                                            First few characters of message...
                                        </span>
                                </td>
                            </tr>

                            <tr onclick="window.document.location='Messaging.php?UserID1=&&UserID2=';">
                                <td>
                                    <img src="images/UserStock.png" style="height:75px;width:auto">
                                </td>
                                <td>
                                    <span class="userNames">Jill</span>
                                    <br>
                                        <span class="status">
                                           First few characters of message...
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
             
                </script>

                </div>
            </div>

            <div class="span6">
                <div class="box">
                    <div class="header">
                        <h4>Reccommended Users</h4>
                    </div>
                    <div class="content">

                        <table class="table table-condensed margin-reset">
                            <tbody>

                            <!-- link stores user id of both users that will be messaging -->
                            <tr onclick="window.document.location='Messaging.php?UserID1=&&UserID2=';">
                                <td>
                                    <img src="images/UserStock.png" style="height:75px;width:auto">
                                </td>
                                <td>
                                    <span class="userNames">Bob</span>
                                    <br>
                                        <span class="status">
                                            Associated Task
                                        </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="images/UserStock.png" style="height:75px;width:auto">
                                </td>
                                <td>
                                    <span class="userNames">Sally</span>
                                    <br>
                                        <span class="status">
                                            Associated Task
                                        </span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <img src="images/UserStock.png" style="height:75px;width:auto">
                                </td>
                                <td>
                                    <span class="userNames">Jill</span>
                                    <br>
                                        <span class="status">
                                            Associated Task
                                        </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>


    <div id="push"></div>
</div>

<div id="push"></div>
</div>

<div id="footer">
    <br>
    <div class="container">
        <p class="muted credit" style="color: white">COP 4331 Project 2</p>
    </div>
</div>


</body>
</html>
