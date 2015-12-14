
							
							<div class="col-lg-12">
							 <div class="box box-primary">
							 	<div class="page-header">
							 	<a href="?folder=customers&file=emailcron" class="btn btn-primary"><i class="fa fa-refresh"> </i> Update E-mails</a>
							 </div>
							<div class="box-body">

								<?php
				

$clid=$_GET['cl_id'];

$clients=$dbqzbmc->get_results("SELECT * FROM email_details WHERE ed_cust_id='$clid'");


if($clients)
{
	?>
	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info">
	
<thead>
	<tr>

<th>Status</th>
<th>Datetime</th>
<th>Sender</th>
<th>Subject</th>
<th>Opens</th>
<th>Clicks</th>


<th colspan="2">Actions</th>
	</tr>
</thead><tbody>
	<?php

foreach($clients as $cl)
{

?>
<tr>


<?php
$decode=json_decode($cl->ed_json);

?>

 


<td><?php echo $cl->ed_status;?></td>
<td><?php echo $cl->ed_datetime;?></td>
<td><?php echo $decode->sender;?></td>
<td><?php echo $decode->subject;?></td>
<td><?php echo $decode->opens;?></td>
<td><?php echo $decode->clicks;?></td>

<td><a href="?folder=customers&file=emailcontent&e_id=<?php echo $cl->ed_email_id;?>" class="btn btn-primary"><i class="fa fa-envelope">
View Content</a></td>
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
		