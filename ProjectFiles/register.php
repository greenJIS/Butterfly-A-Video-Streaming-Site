 <?php
session_start();
ob_start();
require('connect.inc.php');
unset($_SESSION['id2']);
$name=htmlentities($_POST['username']);
 


if(isset($_POST['email'])&&!empty($_POST['email'])
	&& isset($_POST['username'])&&!empty($_POST['username'])
    && isset($_POST['password'])&&!empty($_POST['password']))
{
      $email=htmlentities($_POST['email']);
      $name=htmlentities($_POST['username']);  
      $password=htmlentities($_POST['password']);
      $query="SELECT 'email' FROM `users` WHERE email='$email'";
	 
        if($query_run = mysql_query($query))
		{
	      if(mysql_num_rows($query_run)==NULL)	
		  {		
		     $query="INSERT INTO `users` (`email`, `pwd`, `profile_name`, `user_id`) 
		     VALUES ('$email', '$password', '$name', NULL)";
				if($query_run = mysql_query($query))
				{
					$query="SELECT `user_id` FROM `users` 
					WHERE email='$email' AND pwd='$password'";
					if($query_run = mysql_query($query))
					{
						if(mysql_num_rows($query_run)!=NULL)
						{
							while($query_row=mysql_fetch_assoc($query_run))
							{
								$id=$query_row['user_id'];
								$_SESSION['id']=$id;
								$_SESSION['id2']=0;
								//echo "success";
								header('Location: index.php');
							}
						}
					}

				}
				else
				{
					echo "no insert";
					die();
				}
			
			}
		    else
			{
				$_SESSION['id2']=$name;
			  header('Location:signup.php');
		    }
	    }
		else
		{$_SESSION['id2']=$name;
			  header('Location:signup.php');
		}
	
}
else
{$_SESSION['id2']=$name;
	header('Location:signup.php');
}
?>