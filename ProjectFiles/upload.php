<?php
require('connect.inc.php');
session_start();
ob_start();
$id=$_SESSION['id'];
$target_dir= "upload/";
$random=rand(); 
$vn=htmlentities($_POST['name']);
		$vt=htmlentities($_POST['topics']);

if(isset($_POST['name'])&&!empty($_POST['name'])
	&& isset($_POST['topics'])&&!empty($_POST['topics']))
{
	//echo "1st if uploader";
	$name=$_FILES["video"]["name"];
	$type=explode('.',$name);
	$type=end($type);
	$name=$random.'.'.$type;
	echo $name;
	$target_file = $target_dir.$name ;
	$type=pathinfo($target_file,PATHINFO_EXTENSION);
	if($type!= "mp4" && $type!= "avi" &&$type!= "mov" &&$type!= "3gp" &&$type!= "mpeg")
	{
		$message="file not support";
		//header('Location: upload-page.php');
		
	}else
	{
		$vn=htmlentities($_POST['name']);
		$vt=htmlentities($_POST['topics']);
		$video_path=$_FILES["video"]["name"]; 
		$time=time();
		$time=date('d M Y @ H:i:s',$time);
		$ffmpeg = "C:\\ffmpeg\\bin\\ffmpeg";
		// where ffmpeg is located

$ffmpeg = "C:\\ffmpeg\\bin\\ffmpeg";

//video dir
$video = $_FILES["video"]["tmp_name"];
//where to save the image
$name1=$random.'.'.'jpg';
$target_file1 = 'thumbnail/'.$name1 ;
$image = $target_file1;
//time to take screenshot at
$interval = 10;

//screenshot size
$size = '300x200';
 
//ffmpeg command
$cmd = "$ffmpeg -i $video  -an -ss $interval -s  $size  $image";
echo shell_exec($cmd);


		  
		if(move_uploaded_file($_FILES["video"]["tmp_name"],$target_file) && !shell_exec($cmd))
		{	
			$query="INSERT INTO `video` (`video_id`, `video_name`, `video_owner`, `likes`, `view`, `date`, `topics`,`video_link`,`t_link`)
		VALUES (NULL, '$vn', '$id', '0', '0', '$time', '$vt','$target_file','$target_file1')";
		if($query_run = mysql_query($query))
				{
					
			     header('Location: index.php');
				}
				else
				{
				
					die();
				}
			
	
		}
		
	}		

}else
	
header('Location: upload-page.php');
?>