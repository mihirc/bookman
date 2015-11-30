<?php

include('./template/head.php');


define("_BOOKMAN_INIT",true);

session_start();

ob_start();


global $db;
if(!isset($_SESSION['ad_id']))
{
	
header('location:login.php');
}
include_once("../private/conn.php");
include_once("../private/functions.php");
if(isset($_GET['folder']))
{
	$folder=$_GET['folder'];
}
else
{
	$folder='superadmin';
}

//include('includes/Get_table_view.php');

 include('includes/function.php');


			include_once('includes/'.$folder.'/query/querycontroller.php');

?>
  <div id="wrapper">  


<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
            </div>
            <!-- /.navbar-header -->


<?php

include('./template/topbar.php');

?>

<?php

include('./template/left.php');
?>
    </nav>


<div id="page-wrapper">
      <?php 
            if(isset($_GET['folder']))
	  {
		  /*echo'this is folder'.$folder; */
		  ?>
  <!-- Content Wrapper. Contains page content -->
    



       
        <!-- Content Header (Page header) -->
        <?php
        
           include_once('includes/'.$folder.'/breadcrumbs.php');
        ?>

        <!-- Main content -->
       
          <!-- Info boxes -->
          <div class="row">
				
                 <?php
				// global $msg;
				 //echo $msg;
                 
                 include_once('includes/'.$folder.'/controller.php');

                 ?>
                     </div>
    
    

 <?php

      }
      else
      {
	      
	      // echo dashboard(); 
      }
      ?>

        </div>
          </div>
        <?php
    include('./template/footer.php');
    ?>

