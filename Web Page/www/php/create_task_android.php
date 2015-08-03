<?php
require_once 'task_class.php';

$task = new task();

//Initialize task fields
$task->createFromPost($_POST);

//Try to put task into DB
$errors = $task->register();
if($errors==NULL && isset($_POST['image']))
{
  $errors = $task->uploadImg(base64_decode($_POST['image')]);
}

//If no errors, return a happy message
if($errors==NULL)
{
  $errors['submitted']=true;
  $errors['taskid'] = $task->taskid;
}

//Echo errors as JSON object
echo json_encode($errors);

?>
