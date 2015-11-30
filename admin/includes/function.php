  
<?php

function DeleteModal1($Id,$link)
{
?>
<a href='#' data-toggle="modal" class="btn btn-primary" data-target="#myModal<?php echo'PopUpSend'.$Id;?>" Title='Delete'>
  <i class="glyphicon glyphicon-trash"></i></span></a>

          <div class="modal fade" id="myModal<?php echo'PopUpSend'.$Id;?>" tabindex="-1" role="dialog" aria-labelledby="purchaseLabel" aria-hidden="true">
              <div class="modal-dialog">
              
              
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="purchaseLabel">Delete</h4>
                      </div>
                      <div class="modal-body">
                
            
        
                  
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <input type='hidden' name='userid' value='<?php echo $id;?>'>
                <!--<input type='submit' name='sendEmail' class="btn btn-primary" value='Send Email'>!-->
                         <?php  echo $link;?>
                      </div>
                  </div>
                  
                 
              </div>
          </div>
<?php

}
?>


<?php  


       
   

function dashboard_search()
{
  ?>

<script>

 function GetFeetype()
 {
if(window.XMLHttpRequest)
{
xmlhttp=new XMLHttpRequest();
}
else
{
xmlhttp= new ActiveXObject('Micosoft.XMLHTTP');
}
xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("member").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open('GET','includes/members/ajax.php?mem_id='+document.getElementById('search').value,true);
xmlhttp.send();
  
 }







 
</script>
<section class="content">
          <div class="row">
            <!-- left column -->
            
            
            <div class="col-md-12">

              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  
                </div><!-- /.box-header -->
             <div class="box-body">



                    <div class="form-group">
                      <label for="exampleInputEmail1">Search Member</label>

                      <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" id="search" placeholder="Search Member" name="member" onkeyup="GetFeetype();">
                  </div>



                     
                                        </div>
                      <div id="member">

                      </div>
   
             
             </div>
                  </div>

<div id="memberdetails">

                      </div>
            </div>

            </section>

        
        
  <?php
}
  
function dashboard()
{
global $db;

?>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Version 2.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Info boxes -->
          <div class="row">

<section class="col-lg-12 connectedSortable ui-sortable">


	         
               <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>5<sup style="font-size: 20px"></sup></h3>
                  <p><b>Total Vehicles</b></p>
                </div>
                <div class="icon">
                  <i class="fa fa-motorcycle"></i>
                </div>
                <a href="?folder=unclaimedvehicles&file=view" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->


              
              
              
</section>

                </div>
          
        </section>
      </div>
                 

<?php
}




function welcome_msg()
  {
    ?>


        <script src="bootstrap/js/jquery.min.js"></script>
    
<style>


.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  position: fixed;
  left: 0px;
  top: 0px; 
  color:#fff;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url(./dist/img/482.GIF) center no-repeat black;
}

.se-pre-con h1{
  text-align: center;
  margin-top: 240px;
  font-size: 45px;
}
</style>
<script>

    //paste this code under head tag or in a seperate js file.
  // Wait for window load
  $(window).load(function() {
    // Animate loader off screen
    setTimeout(
  function() 
  {
    //do something special
    $(".se-pre-con").fadeOut("slow");;
      }, 1400);
  });

 
    </script>
  
<div class="se-pre-con"> 

<h1>WELCOME TO Vehicle-Soft</h1></div>
<?php

  }













  function report($vid)
{
global $db;
include_once('./dompdf/dompdf_config.inc.php');

//include_once('./includes/invoice/function.php');


//$adid=$_SESSION['ad_id'];

$html='';




$html.='<table width="100%"><tr>
<td><img src="./images/logo.jpg" height="90" width="90"></td>
<td><h4>Dt. '.date("d/m/Y").'</h4> </td>
</tr></table>';





$html.='<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#customers td, #customers th {
    font-size: 1em;
    border: 1px solid #173A6E;
    padding: 3px 7px 2px 7px;
}

#customers th {
    font-size: 15px;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #173A6E;
    color: #ffffff;
}

</style>';



//$html.=$vid;


 $rw=$db->get_row("SELECT * FROM unclaimed_vehicle WHERE v_id='$vid'");
  
 $loc=$db->get_row("SELECT * FROM location WHERE loc_id='$rw->location'");
 $brand=$db->get_row("SELECT * FROM v_brand WHERE v_b_id='$rw->v_b_id'");


$html.='
<table id="customers">
              
              
              <tr>
                <th>Vehicle</th>
                <th>Vehicle No.</th>
                <th>Brand</th>
                <th>Engine No.</th>
                <th>location</th>
                <th>Date</th>
               

              </tr>';
                
$html.='
<tr>
  <td>'.$rw->vehicle.'</td>
  <td>'.$rw->vehicle_no.'</td>
  <td>'.$brand->v_brand.'</td>
  <td>'.$rw->engine_no.'</td>
  <td>'.$loc->location.'</td>
  <td>'.$rw->date.'</td>';

  $html.='</tr></table>';
              


$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
//$output = $dompdf->output();
$dompdf->stream("report.pdf");



}


?>



