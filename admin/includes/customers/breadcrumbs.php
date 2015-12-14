<section class="content-header">
          <h1>
            Admin 
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>


            <li><a href="index.php?folder=<?php echo $_GET['folder'];?>&file=view"><?php echo $_GET['folder'];?></a></li>

            <?php
            if($_GET['file']=='emailhistory')
            {

            	$id=$_GET['cl_id'];
            	$clients=$dbqzbmc->get_row("SELECT qzbmc_name,qzmbc_id FROM qzbm_clients_subdomains WHERE qzmbc_id='$id'");

            	
            	?>
<li class="active"><?php echo $_GET['file'];?></li><li class="active"><?php echo $clients->qzbmc_name;?></li>
<?php
            }
            else
            {
            ?>
            <li class="active"><?php echo $_GET['file'];?></li>
            <?php
        }
            ?>
          </ol>
        </section>

        