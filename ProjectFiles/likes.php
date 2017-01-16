<?php
require('connect.inc.php');
session_start();
ob_start();
$id=$_SESSION['id'];
$vid=$_SESSION['vid'];
$vlink=$_SESSION['link'];
$likes=$_SESSION['like'];
if(isset($_POST['submit'])&&!empty($_POST['submit']))
    {
    	
								$like=htmlentities($_POST['like']);
								if($like==1)
								{
					                 echo $like;
									$query="INSERT INTO  `likes` (`video_id` ,`liked_by`)VALUES ('$vid', '$id')";
									if($query_run = mysql_query($query))
						            {  
								   
									  $likes=$likes+1;
									  $query="UPDATE  `video` SET  `likes` =  '$likes' WHERE `video_id` ='$vid'";	
									  $query_run = mysql_query($query);
									    $_SESSION['link']=$vlink;
										echo "like up success";
										header('Location: video-pages.php');
									}
								}
								 
    }


?>