<?php

require('connect.inc.php');
session_start();
ob_start();
@$id=$_SESSION['id'];
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
      </ul>
    </div><br>
	<div class="videos">
	<?php
	//$email=htmlentities($_POST['email']);
	if(($_POST['submit'])&&!empty($_POST['submit']))
	{  $search=htmlentities($_POST['search-value']);
		$search='%'.$search.'%';
		$query="SELECT * FROM  `video` WHERE  `video_name` LIKE  '$search' OR  `topics` LIKE  '$search' LIMIT 5";
		if($query_run = mysql_query($query))
		{
			if(mysql_num_rows($query_run)!=NULL)
			{
				while($query_row=mysql_fetch_assoc($query_run))
			  {
				$vn=$query_row['video_name'];
				$thumb=$query_row['t_link'];
				$link=$query_row['video_link'];
				$vid=$query_row['video_id'];
				$likes=$query_row['likes'];
				$view=$query_row['view'];
				$date=$query_row['date'];
				$topics=$query_row['topics'];

				echo "<table CELLSPACING=\"1\" CELLPADDING=\"5\" WIDTH=\"100%\" BORDER=\"1\">
      				  	<tr>
      						  <td class=\"video-thumb\" WIDTH=\"5%\"><img src=\"$thumb\"></td>
      						  <td class=\"video-detail\" WIDTH=\"40%\">
        							<form action=\"video-pages.php\" method=\"post\">
        							<input type=\"hidden\" name=\"video_link\" value=\"$link\">
        							<input style=\"float:right; position: relative; top: 1px;background-color:white;color:red;font-weight:bold;font-size:16px;\" type=\"submit\" name=\"sub\" value=\"Watch\">
        							</form>
        							<h2 style=\"color:red;\">$vn</h2>
        							<p><span style=\"font-weight: bold;\">Likes: </span>$likes</p>
        							<p><span style=\"font-weight: bold;\">Views: </span>$view</p>
        							<p><span style=\"font-weight: bold;\">Topics: </span>$topics</p>
        							<p><span style=\"font-weight: bold;\">Upload Date: </span>$date</p>
      						  </td>
      					</tr>
      				</table>
					<div><br></div>
					";
				}
			}
			else
				{
					echo "<table class=\"videos\" CELLSPACING=\"1\" CELLPADDING=\"5\" WIDTH=\"100%\" BORDER=\"1\">
						<tr>
						  <td>
							<p><span style=\"position: relative;left: 40%;text-align:center;\">Error 404 : No video found</span></p>
						  </td>
						</tr>
					</table>";
				}
		}
		else
	     echo mysql_error(); 	
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

