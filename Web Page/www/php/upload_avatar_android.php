<?php
require_once 'user_class.php';
if(isset($_POST['UserID']) && isset($_REQUEST['Img']))
{
  $userid = $_POST['UserID'];
  $image = $_REQUEST['Img'];
  
  $user = new user();
  $user->getFromDB($userid);
  
  $avatarfilepath = '/var/www/html/images/avatars/';
  $avatarfilename = $avatarfilepath.$user->userid.'.jpg';
  
  header('Content-Type: bitmap; charset=utf-8');
  $imagefile = fopen($avatarfilename,'wb');
  fwrite($imagefile, base64_decode($image));
  fclose($imagefile);
  $allowedext=array("jpg");
  //if(exif_imagetype != IMAGETYPE_JPEG)
  
  $result=null;
  
  if(!in_array(pathinfo($avatarfilename,PATHINFO_EXTENSION),$allowedext))
  {
    $result['errorFileNotJPG']=true;
    unlink($avatarfilename);
  }
  else
  {
     
  }
 
  
  //$result = $user->DEBUGuploadAvatar($imagefile);
  
  if($result==null)
  {
    $result['success']=true;
  }
  
  echo json_encode($result);
}
else
{
  $error['error']=true;
  $error['UserID or Img not set']=true;
  echo json_encode();
}
?>
