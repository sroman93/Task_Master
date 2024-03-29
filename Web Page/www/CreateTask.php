<?php

if (session_status() == PHP_SESSION_NONE) 
{
	session_start();
}

//must be logged in to create a task, redirect them
if (!isset($_SESSION['userid']))
{
	$_SESSION['login_redirect'] = $_SERVER['PHP_SELF'];
	header("Location: /Login.php");
}

//remember submitted values in case of error
$_title = '';
$_description = '';
$_content = '';
$_location = '';
$_category = '';
$_tags = '';

//Task form was submitted
if (isset($_POST['submit']))
{
	include_once 'php/task_class.php';
	
	$_POST['numimg'] = 0;
	foreach ($_FILES['imageinput']['error'] as $value)
	{
		if ($value == UPLOAD_ERR_OK)
			$_POST['numimg']++;
	}
	
	//form date string
	$enddatetime = $_POST['enddate']." ".$_POST['endtime'];
	
	//convert it to Unix timestamp
	$_POST['enddatetime'] = strtotime($enddatetime);
	
	$newtask = new task();
	$newtask->createFromPost($_POST);
	
	$error = $newtask->register();
	
	if ($error == NULL)
		$imgerror = $newtask->uploadImg($_FILES['imageinput']);
	
	//did task submission succeed?
	if ($error == NULL && $imgerror == NULL) //success, redirect to new task and show message
	{
		$_SESSION['msg_taskmade'] = "Task Created";
		header("Location: ViewTask.php?id={$newtask->taskid}");
		die;
	}
	else //did not, restore submitted values
	{
		if (isset($error['userid'])) $_SESSION['msg_needlogin'] = "Need login";
		
		if (isset($_POST['title'])) $_title = $_POST['title'];
		
		if (isset($_POST['description'])) $_description = $_POST['description'];
		
		if (isset($_POST['content'])) $_content = $_POST['content'];
		
		if (isset($_POST['location'])) $_location = $_POST['location'];
		
		if (isset($_POST['category'])) $_category = $_POST['category'];
		
		if (isset($_POST['tags'])) $_tags = $_POST['tags'];
	}
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


    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    <!-- Resource for TimePicker Plugin -->
    <script src="dist/js/bootstrap-formhelpers.min.js"></script>
    <link rel="stylesheet" href="dist/css/bootstrap-formhelpers.min.css">


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
            $( "#datepicker" ).datepicker({minDate: 0});
        });

        $(function() {
            $( "#datepicker2" ).datepicker({minDate: 0});
        });
    </script>

</head>

<body>

<!-- Part 1: Wrap all page content here -->
<div id="wrap">

    <!-- Fixed navbar -->
    <?php include "NavMod.php"; ?>

    <!-- Begin page content -->
    <div class="container" style="border:black 9px">
	<?php include "php/alerts.php"; ?>
		<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8" style="border: 1px solid #ddd; border-radius: 3px 3px 3px 3px;padding: 14px 26px 26px;box-shadow: 4px 4px 1px #c4c4c4;">

                        <!-- Form Name -->
                        <legend>Task Creation</legend>

                        <br>

                        <!-- Text input-->
                            <div class="control-group">
                                <label class="control-label" for="title">Title</label>
								<?php if (isset ($error['title'])) echo '<font color = "red">Invalid title</font>'; ?>
                                <div class="controls">
                                    <input id="title" name="title" type="text" placeholder="title" class="input-xlarge form-control" value="<?php echo $_title; ?>">
                                </div>
                            </div>

                            <!-- Textarea -->
                            <div class="control-group">
                                <label class="control-label" for="description">Task Description</label>
								<?php if (isset ($error['description'])) echo '<font color = "red">Invalid description</font>'; ?>
                                <div class="controls">
                                    <textarea id="description" name="description" placeholder="Short description" class="form-control"><?php echo $_description; ?></textarea>
                                </div>
                            </div>
							
							<!-- Textarea -->
                            <div class="control-group">
                                <label class="control-label" for="content">Task Information</label>
								<?php if (isset ($error['content'])) echo '<font color = "red">Invalid instructions</font>'; ?>
                                <div class="controls">
                                    <textarea id="content" name="content" placeholder="Detailed information and instructions about task" class="form-control"><?php echo $_content; ?></textarea>
                                </div>
                            </div>
							
							<div class="control-group">
                                <label class="control-label" for="location">Location</label>
								<?php if (isset ($error['location'])) echo '<font color = "red">Invalid location</font>'; ?>
                                <div class="controls">
                                    <input id="location" name="location" type="text" placeholder="Location" class="input-xlarge form-control" value="<?php echo $_location; ?>">
                                </div>
                            </div>


                            <!-- Select Multiple -->
                            <div class="control-group">
                                <label class="control-label" for="category">Select Task Category</label>
                                <div class="controls">
                                    <select id="category" name="category" class="input-xlarge form-control" multiple="multiple">
                                        <?php
										require_once 'php/task_category.php';
										
										$categories = array();
										$categories = getCategories();
										
										foreach($categories as $category)
											echo "<option value='{$category->id}'>{$category->title}</option>\n";
										?>
                                    </select>
                                </div>
                            </div>


                            <!-- input amount willing to pay-->
                            <br>
                            <p><b>Initial Task Pay</b></p>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
									<input type="text" class="form-control" placeholder="US Dollar" name="price">
                                <span class="input-group-addon">.00</span>
                            </div>
                        

                        <br>



                        <div id="custom-search-input">
                            <label class="control-label">Related Keywords</label>
							<?php if (isset ($error['tags'])) echo '<font color = "red">Invalid tags</font>'; ?>
                            <div class="input-group col-md-12 col-sm-12">
                                <input type="text" name="tags" class="search-query form-control" placeholder="Enter hashtags" value="<?php echo $_tags; ?>"/>
                                <span class="input-group-btn">
                                    <button class="btn" type="button">
                                        <span class=" glyphicon glyphicon-question-sign"></span>
                                    </button>
                                </span>
                            </div>
                        </div>

                        <br>

                        <!-- Date to end bidding -->
                        <b>End Bidding Date and Time:</b> <div data-name="enddate" id="enddate" class="bfh-datepicker" data-min="today" data-close="false" data-format="m/d/y" style="margin-bottom: 2px"></div>

                        <!-- Time to end bidding -->
                        <div data-name="endtime" id="endtime" class="bfh-timepicker" placeholder="Select Time" style="margin-bottom: 20px"></div>


                        <script>
                            $().bfhtimepicker("toggle");
                            $().bfhdatepicker("toggle");
                        </script>

                         <!-- File Button -->
                        <div class="control-group">
                            <label class="control-label" for="imageinput">Select Images</label>
							<?php if (isset ($imgerror['imgupload'])) echo '<font color = "red">Images did not upload</font>'; ?>
                            <div class="controls">
                                <input id="imageinput" name="imageinput[]" class="input-file" type="file" multiple="true" accept="image/jpeg">
                            </div>
                        </div>

                        <br><br>

                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
							<input type="submit" name="submit" class="btn btn-primary btn-lg raised" value="Submit">
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <a href="http://travis-webserver.dyndns.org:81/index.php"><button type="button" class="btn btn-primary btn-lg raised" onclick="#">Cancel</button></a>
                        </div>

                    </div>

                    <!-- Help side div-->
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <p>Welcome to the Task Creation page.  Congratulations you have taken
                        the first step to having your task completed by a Task Master.</p><br>

                        <p>The <b>Title</b> field is used to title the task so others can acurrately choose
                        an applicable task.</p>
                        <p>The <b>Task Description</b> is a short anecdote of the task that you would like one our Task Masters to complete.</p>
                        <p>The <b>Task Information</b> field is a detailed explanation of the task.</p>
                        <p>The <b>Location</b> field specifies the area the task will take place</p>
                        <p>For the <b>Select Task Category</b> field choose the category that most closely relates to the task.</p>
                        <p>The <b>Initial Task Pay</b> field is used to set the amount you are willing to pay for someone
                        to do the task at hand.</p>
                        <p>The <b>Related Keywords</b> field asks that you input words that relate to the task. For example,
                        if the task were "Bake a cake", keywords that would apply would be "food, baking, bake, cake, sweets,..."</p>
                        <p>The <b>End Bidding Dat and Time</b> field allows you to select the date and time to end the bidding.</p>
                        <p>The <b>Select Images</b> button allows you to input any revalent images if any.</p>
                    </div>


                </div>

            </fieldset>
        </form>


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
