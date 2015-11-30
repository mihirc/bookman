<?php
session_start();
session_destroy();

if($_POST)
{ 
/* print_r($_POST); */
	if(isset($_POST['uname']) && isset($_POST['pass']))
	{
		
		$username=$_POST['uname'];
		
		$password=$_POST['pass'];
		
		$adname='amit';
		

		if($username=='admin' && $password=='admin')
		{
		 		session_start();
          
          $_SESSION['ad_id']=$adname;
				
			
					
					header('location:index.php');
					echo 'true';

		}
		else
		{
			
	global $msg;
		$msg="<span style='color:red;'>Please enter the valid username & password</span>";
		//echo'dsfsdfdsf';
		}
	
	}
	else
	{
	}

}

?>


	
        <link rel="stylesheet" href="css/style.css">
        
        <div id="login">

  <div id="triangle"></div>
  <h1>Log in</h1>
  <form method="POST">
  	<?php
if(isset($msg))
{
	echo $msg;
}
    ?>
    <input type="text" placeholder="Username" name="uname"/>
    <input type="password" placeholder="Password" name="pass"/>
    
   <br> <input type="submit" value="Log in" />
  </form>
</div>
   

               


      