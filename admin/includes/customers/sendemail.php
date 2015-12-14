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
								


<div class="form-group">
                      <label for="exampleInputEmail1">Subject</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="subject" value="">
                      </div>




<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>



<div class="form-group">
                      <label for="exampleInputEmail1">Message Body</label>
							<textarea class="form-control" name="email_text"></textarea>
						</div>
							
							
							<br><input type="submit" name="sendemail" class="btn btn-primary" value="Send">
							
							</div>
				</div>
			</div>
			</form>