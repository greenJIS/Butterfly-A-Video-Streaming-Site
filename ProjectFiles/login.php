<?php
require('connect.inc.php');
session_start();
ob_start();
unset($_SESSION['id']);
unset($_SESSION['id3']);
     $email=htmlentities($_POST['email']);
	 $_SESSION['id3']=$email;
      //$password=htmlentities($_POST['password']);
  //echo $email;
   //echo  $password;	  
	  
if(isset($_POST['email'])&&!empty($_POST['email']) 
   &&isset($_POST['password'])&&!empty($_POST['password']))
{      
  	  $email=htmlentities($_POST['email']);
      $password=htmlentities($_POST['password']);
	  $emails = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false)
	{
    	$query="SELECT `user_id` FROM `users` WHERE email='$email' AND pwd='$password'";
			if($query_run = mysql_query($query))
			{
				if(mysql_num_rows($query_run)!=NULL)
				{
					while($query_row=mysql_fetch_assoc($query_run))
					{
						$id=$query_row['user_id'];
						$_SESSION['id']=$id;
		
						header('Location: index.php');
					}
				}
				else
				{
					//echo "database e nai";
					$_SESSION['id3']=$email;
					header('Location: login2.php');
				}
			}
			else
			{
				echo mysql_error();
			}
    } 
	else 
	{
		
      header('Location: login2.php');
    }
			
}

else
{
	//echo "kicui hoccena"; 
	
	
header('Location: login2.php');	
}  


?>