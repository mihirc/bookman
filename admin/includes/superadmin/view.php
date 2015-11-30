
							
							<div class="col-lg-12">
							 <div class="box box-primary">
							<div class="box-body">

								<?php
							
$clients=$db->get_results("SELECT * FROM qzbm_clients_subdomains");


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
<td><a href="?folder=superadmin&file=sendemail&cl_id=<?php echo $cl->qzmbc_id;?>" class="btn btn-primary"><i class="fa fa-envelope"></a></td>
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
		