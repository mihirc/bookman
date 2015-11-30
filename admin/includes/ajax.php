<?php


include($_SERVER['DOCUMENT_ROOT']."/structure/connection.php");







if(isset($_GET['unclaimedv_no']))
{
$no= $_GET['unclaimedv_no'];

//$no1= $_GET['detail_id'];

//echo $no;
$vehicleno1 = str_replace(' ', '', $no);

$qry=$db->get_results("SELECT sv_no1 FROM stolen_vehicles WHERE sv_no1 = '$vehicleno1'");
//$db->debug();




if($qry)
{
echo'<span class="label label-danger">Vehicle already exists in Stolen vehicles</span>';




}

}




if(isset($_GET['detail_id']))
{

$no1= $_GET['detail_id'];

if($no1!='')
{

$vehicleno2 = str_replace(' ', '', $no1);

$qry11=$db->get_row("SELECT * FROM unclaimed_vehicle WHERE vehicle_no1 = '$vehicleno2'");


//$db->debug();

if($qry11)
{
  $brand=$db->get_row("SELECT * FROM v_brand WHERE v_b_id='$qry11->v_b_id'");

$loc=$db->get_row("SELECT * FROM location WHERE loc_id='$qry11->location'");

?>
<div class="col-md-6">
             <div class="box-body">
            </div>

              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h4>Vehicle Details</h4>
                </div><!-- /.box-header -->
             <div class="box-body">

<table class="table table-borderd">
<tr>
<th>Vehicl No.</th><th>Vehicle Name</th><th>Brand</th><th>Engine No.</th><th>Chasis No.</th><th>Location</th><th>City</th><th>Actions</th>
<tr>
<tr>
<td><?php echo $qry11->vehicle_no;?></td>
<td><?php echo $qry11->vehicle;?></td>
<td><?php echo $brand->v_brand;?></td>
<td><?php echo $qry11->engine_no;?></td>
<td><?php echo $qry11->chasis_no;?></td>
<td><?php echo $loc->location;?></td>
<td><?php echo $qry11->city_id;?></td>
<td><a href="?folder=unclaimedvehicles&file=unclaimedvehicle&ed_id=<?php echo $qry11->v_id;?>" Title="Edit"><i class="fa fa-edit" class="btn btn-default"> </i></a></td> 
</tr>
</table>
             
             </div>
                  </div>

<?php
}


}









}








































?>