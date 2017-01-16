<?php

require('connect.inc.php');
session_start();
ob_start();
@$id=$_SESSION['id'];
@$vlink=$_SESSION['link'];
@$vid=$_SESSION['id'];
if($id)
{
	$id=$_SESSION['id'];
	$query="SELECT `profile_name` FROM  `users` WHERE  `user_id` =$id";
	$query_run = mysql_query($query);
    while($query_row=mysql_fetch_assoc($query_run))
     {
		 $m1=$query_row['profile_name'];
	 }
}
else
	$id=0;

?>

<!DOCTYPE html>
<html id="top">
<head>
  <title>Butterfly: Fun, Share, Learn</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script type="text/javascript"></script>
  <style type="text/css">
  </style>
</head>

<body background="photos/background.jpg">
<div class="whole-page">
  <div class="topbar">
    <div class="name">
      <img src="photos/name.gif" alt="name" wclassth="120" height="60">
    </div>
    <div class="topmenu">
      <ul>
        <a href="index.php">Home</a>
         <a href="tranding.php">Trending</a>
      </ul>
    </div>
	
    <div class="search">
      <form class="search_form" action="search-result.php" method = "post">
        <input type="text" name="search-value" placeholder="Search here...">
        <button type="submit" class="button" name='submit' value="Search">Q</button>
      </form>
    </div>
    <div class="upload_button">
      <button type="button" class="button"><a href="upload-page.php">Upload</a></button>
    </div>
	<div class="loginfo">
		<?php
			if($id)
			{
				echo "<label class=\"user-label\"><a href=\"user-profile.php\"> $m1 </a></label>"; 
				echo '   ';
				echo '<button type="button" class="button2"><a href="logout.php"> SignOut</a></button>';
			}
			else
			{
				echo '<button type="button" class="button2"><a href="login2.php">SignIn</a></button>';
				echo '   ';
				echo '<button type="button" class="button2"><a href="signup.php">SignUp</a></button>';				
			}
		?>
	</div>
    <div class="clear"></div>
  </div>

<div class="content content-group">
    <div class="catagories" ><br>
      <label style="text-align: center; font-size: 22px; color: blue; font-weight: bold;">Topics</label>
      <ul class="content-list">
        <li>
			<form action="search-result.php" method="post">
				<input type="hidden" name="search-value" value="Animation">
				<input type="submit" style="background-color: transparent; border: none; font-size: 16px; color: red; font-weight: bold;" name="submit" value="Animation">
			</form>
		</li>
        <li>
			<form action="search-result.php" method="post">
				<input type="hidden" name="search-value" value="Study">
				<input type="submit" style="background-color: transparent; border: none; font-size: 16px; color: red; font-weight: bold;" name="submit" value="Study">
			</form>
		</li>
        <li>
			<form action="search-result.php" method="post">
				<input type="hidden" name="search-value" value="Game">
				<input type="submit" style="background-color: transparent; border: none; font-size: 16px; color: red; font-weight: bold;" name="submit" value="Game">
			</form>
		</li>
        <li>
			<form action="search-result.php" method="post">
				<input type="hidden" name="search-value" value="TV Series">
				<input type="submit" style="background-color: transparent; border: none; font-size: 16px; color: red; font-weight: bold;" name="submit" value="TV Series">
			</form>
		</li>
        <li>
			<form action="search-result.php" method="post">
				<input type="hidden" name="search-value" value="Natok">
				<input type="submit" style="background-color: transparent; border: none; font-size: 16px; color: red; font-weight: bold;" name="submit" value="Natok">
			</form>
		</li>
		</li>
      </ul>
    </div><br>
	
	<div class="videos">
	<?php
		if(isset($_POST['sub'])&&!empty($_POST['sub']))
		{   	
			$vlink=htmlentities($_POST['video_link']);
			$query="SELECT * FROM  `video` WHERE  `video_link` = '$vlink' ";
			if($query_run = mysql_query($query))
			{
				while(@$query_row=mysql_fetch_assoc($query_run))
				{
					$vn=$query_row['video_name'];
					$thumb=$query_row['t_link'];
					$link=$query_row['video_link'];
					$vid=$query_row['video_id'];
					$likes=$query_row['likes'];
					$view=$query_row['view'];
					$date=$query_row['date'];
					$topics=$query_row['topics'];
					//$_SESSION['like']=$likes;
					$_SESSION['vid']=$vid;
					$_SESSION['link']=$vlink;
					$_SESSION['like']=$likes;
					
					
					echo "<section>
							<video class=\"main-video\" width=\"90%\" height=\"90%\" controls>
								<source src=\"$vlink\">
							</video>";
					
					if($id)
					{
						
						$query="SELECT * FROM  `likes` where `video_id`='$vid' AND `liked_by`='$id' ";
						
						if($query_run = mysql_query($query))
						{
							if(mysql_num_rows($query_run)==NULL)
						    { 
								echo "<form action=\"likes.php\" method=\"POST\">
									<input type=\"hidden\" name=\"like\" value=\"1\">
									<input type=\"submit\" style=\"position: relative;top: 20px;left:90%;background-color: transparent; border: 2px solid white; font-size: 20px; color: blue; font-weight: bold;\" name=\"submit\" value=\"Like\">
									</form>";
								
						    }else
								die();
						}
					
					}
					echo "<label class=\"video-name\"><h3>$vn</h3></label>
							<label class=\"video-description\" >Topics:$topics </label><br>
							<label class=\"video-description\" >Likes:$likes </label><br>
							<label class=\"video-description\" >Views:$view </label><br>
							<label class=\"video-description\" >Upload Date:$date </label><br>
							
							<label class=\"video-description\" style=\"font-size: 17px; color: black;\"></label><br>
							<label class=\"video-description\" style=\"font-size: 17px; color: black;\"></label><br>
							
							<form action=\"comment.php\" method=\"post\">
								<input type=\"hidden\" name=\"comment-link\" value=\"$link\">
								<TEXTAREA style=\"resize: none;position: relative; left: 20px;background-color:white;color:black;\" rows=\"7\" cols=\"100\" placeholder=\"Type a comment here...\" name=\"comment\" required></TEXTAREA>
								<br>
								<input type=\"submit\" style=\"position: relative; left: 20px;background-color:white;\" name=\"submit\" value=\"Comment\"></input>
        					</form><br>
							
						</section> " ;
						
							$query="SELECT * FROM `comments` WHERE`video_id`='$vid' ORDER BY `time` DESC";
							if($query_run = mysql_query($query))
							{
								if((mysql_num_rows($query_run)!=NULL))
								{
									echo "Commends:<hr>";
									while(@$query_row=mysql_fetch_assoc($query_run))
									{
					
										$date=$query_row['date'];
										$com=$query_row['comments'];
										echo nl2br($com);
										echo "<br>";
										echo "<span style=\"color:#745976;\">Comment Date : $date</span> <br>";
										echo "<br>";
									}
								}
				
							}
						echo "<br>";
			
			}
					
					if($id)
					{
					
						$query="SELECT * FROM  `view` where `video_id`='$vid' AND `viewed_by`='$id' ";
						
						if($query_run = mysql_query($query))
						{
							if(mysql_num_rows($query_run)==NULL)
						    { 
								$query="INSERT INTO  `view` (`video_id` ,`viewed_by`)VALUES ('$vid', '$id')";
					            if($query_run = mysql_query($query))
						        {  
								   
									  $view=$view+1;
									  $query="UPDATE  `video` SET  `view` =  '$view' WHERE `video_id` ='$vid'";	
									  if($query_run = mysql_query($query))
										  echo "";
									
								}	
								
						    }else
								die();
						
						}
						
					}
					
							
					
				}
		}
		else
		{
			$query="SELECT * FROM  `video` WHERE  `video_link` = '$vlink' ";
			if($query_run = mysql_query($query))
			{
				IF(@$query_row=mysql_fetch_assoc($query_run))
				{
					$vn=$query_row['video_name'];
					$thumb=$query_row['t_link'];
					$link=$query_row['video_link'];
					$vid=$query_row['video_id'];
					$likes=$query_row['likes'];
					$view=$query_row['view'];
					$date=$query_row['date'];
					$topics=$query_row['topics'];
						echo "<section>
							<video class=\"main-video\" width=\"90%\" height=\"90%\" controls>
								<source src=\"$vlink\">
							</video>
							
							<label class=\"video-name\"><h3>$vn</h3></label>
							<label class=\"video-description\" >Topics:$topics </label><br>
							<label class=\"video-description\" >Likes:$likes </label><br>
							<label class=\"video-description\" >Views:$view </label><br>
							<label class=\"video-description\" >Upload Date:$date </label><br>
							
							<label class=\"video-description\" style=\"font-size: 17px; color: black;\"></label><br>
							<label class=\"video-description\" style=\"font-size: 17px; color: black;\"></label><br>

							
							<form action=\"comment.php\" method=\"post\">
								<input type=\"hidden\" name=\"comment-link\" value=\"$link\">
								<TEXTAREA style=\"resize: none;position: relative; left: 20px;background-color:white;color:black;\" rows=\"7\" cols=\"100\" placeholder=\"Type a comment here...\" name=\"comment\" required></TEXTAREA>
								<br>
								<input type=\"submit\" style=\"position: relative; left: 20px;background-color:white;\" name=\"submit\" value=\"Comment\"></input>
        					</form><br>

						</section> " ;
						
						$query="SELECT * FROM `comments` WHERE`video_id`='$vid' ORDER BY `time` DESC";
						if($query_run = mysql_query($query))
						{
							if((mysql_num_rows($query_run)!=NULL))
							{
								echo "Commends:<hr>";
								while(@$query_row=mysql_fetch_assoc($query_run))
								{
				
									$date=$query_row['date'];
									$com=$query_row['comments'];
									echo nl2br($com);
									echo "<br>";
									echo "<span style=\"color:#745976;\">Comment Date : $date</span> <br>";
									echo "<br>";
								}
							}
			
						}
						echo "<br>";
			
				}		
			}
			else
				die();
		}
					
      	
	
	?>
	</div>
	
    <div class="ad">AD</div>
     
    
	</div>
  <div class="footer">
    <div class="footer-links footer-links-group">
      <ul class="footer-links-primary footer-links-primary-group">  
        <li><a href="">About</a></li>
        <li><a href="">Press</a></li>
        <li><a href="">Copyright</a></li>
        <li><a href="">Creators</a></li>
        <li><a href="">Developers</a></li>
      </ul>
      <ul class="footer-links-secondary footer-links-secondary-group">  
        <li><a href="">Terms</a></li>
        <li><a href="">Privacy</a></li>
        <li><a href="">Policy &amp; Safety</a></li>
        <li><a href="">Send feedback</a></li>
      </ul>
      <a href="#top" class="back-to-top"></a>
    </div>
  </div>
</div>
</body>
</html>