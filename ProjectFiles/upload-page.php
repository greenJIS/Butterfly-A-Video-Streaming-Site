<?php
require('connect.inc.php');
session_start();
ob_start();
extract($_POST);
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
{
	header('Location: login.php');
}

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
		echo '<button type="button" class="button2"><a href="logout.php"> SignOut</a></button>';
	}
	else
	{
		echo '<button type="button" class="button2"><a href="login.php"> SignIn </a></button>';
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
	
    <div class="videos" style="height:450px; font-size:20px; background:#AAAAAA"><br>
      <form class="login"  action="upload.php" method="POST"  accept-charset='UTF-8' enctype="multipart/form-data">
        <fieldset style="width:40%; position:relative; left: 27%; background:#DDDDDD">
          <!--<input type='hidden' name='submitted' id='submitted' value='1'/>-->
         
          <label for='upload-video' ><h2>Upload A Video</h2></label>
          <label for='video-name' >Video Name</label><br>
          <input type='text' name='name' id='video-name'  maxlength="50" /><br>
			<label for='topics' >Topics</label><br>
            <select name="topics">
			<option>Animation</option>
			<option>Study</option>
			<option>Game</option>
			<option>TV Series</option>
			<option>Natok</option>
			<option>Country</option>
		  </select><br><br>
		  
          <label for='video' >Video</label><br>
          <input type='file' name='video' class="upload-a-video" maxlength="1000" />	<br><br>
         
          <input type='submit' name='Upload' value='Upload' /><br><br>
         
        </fieldset>
      </form>
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

