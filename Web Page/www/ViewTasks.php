<?php

require_once 'php/lister.php';
require_once 'php/task_class.php';

$tasks = array();

if (isset($_GET['Categoryid']))
{
	$catid = $_GET['Categoryid'];
	$tasks = listTasksByCategory($catid);
}
else if (isset($_GET['userid']))
{
	$userid = $_GET['userid'];
	$tasks = listTasksByUser($userid);
}
else
{
	$tasks = listTasksByCategory(0);
}

?>

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


    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

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

        @import url('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css');

        .date-form { margin: 10px; }
        label.control-label span { cursor: pointer; }
		
		.imgcontainer {
			margin-right: 40px;
			width: 200px;
			height: 150px;
			line-height: 150px;
			text-align: center;
			float: left;
		}
		.resize_fit_center {
			max-width:100%;
			max-height:100%;
			vertical-align: middle;
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

    <script>
        $(function() {
            $( "#datepicker" ).datepicker();
        });

        $(function() {
            $( "#datepicker2" ).datepicker();
        });
    </script>

</head>

<script>
function countDownFunc(enddate, divid)
{
	// set the date we're counting down to
	var target_date = new Date(enddate*1000).getTime();

	// variables for time units
	var days, hours, minutes, seconds;

	// get tag element
	var countdown = document.getElementById(divid);

	//countdown function
	function countfn() {

		// find the amount of "seconds" between now and target
		var current_date = new Date().getTime();
		var seconds_left = (target_date - current_date) / 1000;

		// do some time calculations
		days = parseInt(seconds_left / 86400);
		seconds_left = seconds_left % 86400;

		hours = parseInt(seconds_left / 3600);
		seconds_left = seconds_left % 3600;

		minutes = parseInt(seconds_left / 60);
		seconds = parseInt(seconds_left % 60);

		// format countdown string + set tag value
		countdown.innerHTML = days + " days, " + hours + "h, "
			+ minutes + "m, " + seconds + "s";

		//should terminate when countdown is done
		//refresh the page to show new feedback controls
		if(seconds<=0 && minutes<=0 && days<=0 && hours<=0)
		{
			seconds=0;
			minutes=0;
			days=0;
			hours=0;
			clearInterval(timerID);
			countdown.innerHTML = "Bidding ended!"
			return;
		}

	}
	
	countfn();
	// update the tag with id "countdown" every 1 second
	var timerID = setInterval(countfn, 1000);
}

</script>

<!-- Google Maps API -->
<script
    src="http://maps.googleapis.com/maps/api/js">
</script>
<script>
    var myCenter=new google.maps.LatLng(51.508742,-0.120850);

    function initialize()
    {
        var mapProp = {
            center:myCenter,
            zoom:5,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

        var marker=new google.maps.Marker({
            position:myCenter,
        });

        marker.setMap(map);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>

<body>


<!-- Part 1: Wrap all page content here -->
<div id="wrap">

    <!-- Fixed navbar -->
    <?php include "NavMod.php"; ?>
    
    <!-- Begin page content -->
    <div class="container-fluid">
        <div class="row" id="googleMap" style="width:100%;height:380px;"></div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <div class="well bs-sidebar" id="sidebar" style="height:80%;width:150px;">
                <ul class="nav nav-pills nav-stacked">
					<li><p style="text-align:center"><b>Categories:</b></p></li>
					<?php
					require_once 'php/task_category.php';
					
					$categories = array();
					$categories = getCategories();
					
					foreach($categories as $category)
						echo "<li><a href='ViewTasks.php?Categoryid={$category->id}'>{$category->title}</a></li>\n";
					?>
                </ul>
            </div>
        </div>
		<div class="col-md-8 col-sm-8 col-xs-8">
		<?php

		foreach ($tasks as $key=>$task)
		{
		
		?>
        
            <a href="ViewTask.php?id=<?php echo $task->taskid; ?>">
			<div class="row" style="border-bottom:solid lightgrey 2px;border-radius: 3px 3px 3px 3px;padding: 14px 26px 26px;">
                <div class="col-md-12 col-xs-12 col-sm-12">
					<div class="imgcontainer">
						<img class="resize_fit_center" src="<?php echo $task->getThumbURL(); ?>">
					</div>
                    <h3><b><?php echo $task->title; ?></b></h3>
                    <p><?php echo $task->description; ?></p>
                    <p>Current bid: US $<?php echo $task->getCurrentBid();?>.00</p>
					<p>Time Left: <span id="countdown<?php echo $key;?>" style="color:red"></span></p>
					<script>
						var count<?php echo $key;?> = new countDownFunc(<?php echo $task->enddatetime;?>, 'countdown<?php echo $key;?>');
					</script>
                </div>
			</div>
            </a>
        
		
		<?php
		}
		?>
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
