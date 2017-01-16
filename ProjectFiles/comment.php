<?php
require('connect.inc.php');
session_start();
ob_start();
$id=$_SESSION['id'];
$vid=$_SESSION['vid'];
$vlink=$_SESSION['link'];
$likes=$_SESSION['like'];
        $time=time();
		$times=date('d M Y @ H:i:s',$time);
		$com=htmlentities($_POST['comment']);
		echo $com;
if(isset($_POST['submit'])&&!empty($_POST['submit']))
    {
    	
		$com=htmlentities($_POST['comment']);
			echo $com;					
								  
			$query="INSERT INTO  `project`.`comments` ( `video_id` , `comment_by` , `date` , `comments`,`time` ) VALUES ( '$vid',  '$id',  '$times',  '$com','$time');";
			if($query_run = mysql_query($query))
			{  
								   
			$_SESSION['link']=$vlink;
			
			header('Location: video-pages.php');
			}
				else
            echo mysql_error();				
								 
    }


?>

