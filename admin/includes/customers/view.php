
							
							<div class="col-lg-12">
							 <div class="box box-primary">
							 	<div class="page-header">
							 	<a href="?folder=customers&file=emailcron" class="btn btn-primary"><i class="fa fa-refresh"> </i> Update E-mails</a>
							 </div>
							<div class="box-body">

								<?php
							
$clients=$dbqzbmc->get_results("SELECT * FROM qzbm_clients_subdomains WHERE qzbmc_status != '2'");


if($clients)
{
	?>
	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
	
<thead>
	<tr>

<th>Name</th>
<th>Subdomain</th>
<th>Email</th>
<th>Date</th>
<th>Actions</th>
	</tr>
</thead><tbody>
	<?php

foreach($clients as $cl)
{

?>
<tr>
<td><?php echo $cl->qzbmc_name;?></td>
<td><?php echo $cl->qzbmc_subdomain;?></td>
<td><?php echo $cl->qzbmc_emailid;?></td>
<td><?php echo $cl->qzmbc_datejoined;?></td>
<td><a href="?folder=customers&file=sendemail&cl_id=<?php echo $cl->qzmbc_id;?>" class="btn btn-primary" Title="Send Mail"><i class="fa fa-envelope"></i></a>
	
	<a href="?folder=customers&file=emailhistory&cl_id=<?php echo $cl->qzmbc_id;?>" class="btn btn-primary" Title="E-mail History"><i class="fa fa-history"></i></a></td>
</tr>


<?php

}

?>
</tbody>
</table>
<?php


}







?>


					</div>
				</div>
			</div>
		