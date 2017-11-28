<?
   include 'database.php';
   
   include 'header.php';
   
   			  
			  
   
   if($user_id != ""){
	   header("Location: ./index.php");
die();
   }
?>

			<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
			<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
			
			
			<div class="clearfix"> </div>
	      <div class="content">
      	     <div class="register">
		  	  <form id="register_form" class="form-horizontal"> 
			  
						<div class="alert alert-danger" id='errorBox' hidden>
						</div>
						
				 <div class="register-top-grid">
					   
					   
						    <h3>Login Information</h3>
					 <div>
						 <span>UserName<label>*</label></span>
						 <input type="text" name="register_form_username" id="register_form_username" maxlength=30> 
					 </div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
					   </a>
							 <div>
								<span>Password<label>*</label></span>
								<input type="password" name="register_form_password" id="register_form_password" maxlength=30>
							 </div>
							 <div>
								<span>Confirm Password<label>*</label></span>
								<input type="password" name="register_form_cpassword" id="register_form_cpassword" maxlength=30>
							 </div>
							 <div class="clearfix"> </div>
					   <a class="news-letter" href="#"></a>
					 </div>
					 
					 
				     <div class="register-bottom-grid">
							 
							 
					<h3>Personal Information</h3>
				<div>
						<span>First Name<label>*</label></span>
						<input type="text" name="register_form_firstName" id="register_form_firstName" maxlength=30> 
					 </div>
					 <div>
						<span>Last Name<label>*</label></span>
						<input type="text" name="register_form_lastName" id="register_form_lastName" maxlength=30> 
					 </div>
					 
					 <div>
						 <span>Email Address<label>*</label></span>
						 <input type="text" name="register_form_email" id="register_form_email"> 
					 </div>
					 <div>
						 <span>Gender</span>
						 <select name="register_form_gender" id="register_form_gender">
							  <option value="">Please select</option>
							  <option value="Male">Male</option>
							  <option value="Female">Female</option>
							</select>
					 </div>
					 <div style="width: 98%">
						 <span>Residential Address</span>
						 <input type="text" name="register_form_address" id="register_form_address"> 
					 </div>
					
					
					 <div>
						 <span>Phone Number</span>
						 <input type="text" name="register_form_phone" id="register_form_phone" maxlength=8> 
					 </div>
				
                <div class='input-group date'>
						 <span>Birth</span>
                    <input type='text' name="register_form_birth" id='register_form_birth'/>
					
                </div>
				
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
					   </a>
					 </div>
					 
				
							<br>
				<div class="clearfix"> </div>
				<div class="register-but">
					   <input type="button" id="register_form_submit" value="Submit">
					   <div class="clearfix"> </div>
				   </form>
				</div>
		   </div>
           </div>
    </div>
</div>
<script>


            $(function () {
                $('#register_form_birth').datetimepicker({
					
                viewMode: 'years',
                format: 'DD-MM-YYYY',
				maxDate: new Date(),
				defaultDate: new Date()
            });
            });


		$(document).on("keypress", "form", function(event) { 
if (event.keyCode == 13) {
$('#register_form_submit').click();
return false;
}
});
    $(document).ajaxStop($.unblockUI); 
		$('#register_form_submit').on('click', function() {
            $.blockUI(); 
						$('#errorBox').hide();
				$.ajax({
					type: "POST",
					url: "register_reply.php", 
					data: $("#register_form").serialize(),
					success: function(result){
						
						
					try {
						
						var data = jQuery.parseJSON(result);
						
					if(data['msg'] == ""){
						window.location.href = "./index.php";
					}else{
						
						$('#errorBox').empty();
						$('#errorBox').append(data['msg']);
						$('#errorBox').show();
						
						
						jQuery("html,body").animate({
							scrollTop:0
						},1000);
						
					}
					
					
					
					}catch(err) {
						$('#errorBox').empty();
						$('#errorBox').append("Disconnected from the server. Please try later.");
						$('#errorBox').show();
						jQuery("html,body").animate({
							scrollTop:0
						},1000);
						
					}
					},
					error: function (result) {
						
						$('#errorBox').empty();
						$('#errorBox').append("Disconnected from the server. Please try later.");
						$('#errorBox').show();
						jQuery("html,body").animate({
							scrollTop:0
						},1000);
					}
					
					
					
					
					
				});


    });
	</script>
	
	
<?
   include 'footer.php';
?>
