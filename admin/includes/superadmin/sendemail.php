<form method="POST">
<div class="col-md-6">
							 <div class="box box-primary">
							 <div class="box-header">
<?php
if(isset($msg))
{
	echo $msg;
}
?>

							 	<h3 class="box-title">Type E-mail</h3>
							 	
							 								 	
							 	
							 </div>
							<div class="box-body">
							
							<textarea class="form-control" name="email_text"></textarea>
							
							
							<br><input type="submit" name="sendemail" class="btn btn-primary" value="Send">
							
							</div>
				</div>
			</div>
			</form>