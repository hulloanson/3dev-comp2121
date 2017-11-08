<?
   include 'database.php';
   
   include 'header.php';
   
   			  
   require_once('recaptchalib.php');
   if($user_id != ""){
	   header("Location: ./index.php");
die();
   }
?>
			<div class="clearfix"> </div>
	
	      <div class="content">
      	     <div class="register">
			   <div class="col-md-6 login-left">
			  	 <h3>New Member</h3>
				 <p>Creating an account</p>
				 <a class="acount-btn" href="register.php"  style='width:40% ;text-align: center'>Create an Account</a>
				 
				 <br><br><br>
			  	 <h3>Forget Password</h3>
				 <p>If you have already register the account, but forget the login password. You can reset the password via your registered email Address.</p>
				 <a class="acount-btn" href="forgetPassword.php"  style='width:40% ;text-align: center' >Forget Password</a>
			   
			   <br><br><br>
			   </div>
			   
			   <div class="col-md-6 login-right">
			  	<h3>Registered Member</h3>
				<p>If you have an account with us, please log in.</p>
				
						<div class="alert alert-danger" id='errorBox' hidden>
						</div>
				
		  	  <form id="login_form" class="form-horizontal"> 
				  <div>
					<span>Username<label>*</label></span>
						 <input type="text" name="login_form_username" id="login_form_username"> 
				  </div>
				  <div>
					<span>Password<label>*</label></span>
								<input type="password" name="login_form_password" id="login_form_password">
				  </div>
				  <br>
								 <?
  $publickey = "6LcpCAwUAAAAAMPDDKJYyAFfyVROGLvauev820KT"; // you got this from the signup page
  echo recaptcha_get_html($publickey);
								 ?>
								 
				  <input type="button"  id="login_form_submit"  value="Login">
			    </form>
			   </div>	
			   <div class="clearfix"> </div>
		     </div>
           </div>
    </div>
</div>

<script>
	$(document).on("keypress", "form", function(event) { 
if (event.keyCode == 13) {
$('#login_form_submit').click();
return false;
}
});
    $(document).ajaxStop($.unblockUI); 
		$('#login_form_submit').on('click', function() {
            $.blockUI(); 
						$('#errorBox').hide();
				$.ajax({
					type: "POST",
					url: "login_reply.php", 
					data: $("#login_form").serialize(),
					success: function(result){
						
						
					try {
						
						var data = jQuery.parseJSON(result);
						
					if(data['msg'] == ""){
						window.location.href = "./index.php";
					}else{
						
					Recaptcha.reload();
						$('#errorBox').empty();
						$('#errorBox').append(data['msg']);
						$('#errorBox').show();
						
						
						jQuery("html,body").animate({
							scrollTop:0
						},1000);
						
					}
					
					
					
					}catch(err) {
					Recaptcha.reload();
						$('#errorBox').empty();
						$('#errorBox').append("Disconnected from the server. Please try later.");
						$('#errorBox').show();
						jQuery("html,body").animate({
							scrollTop:0
						},1000);
						
					}
					
					},
					error: function (result) {
						
					Recaptcha.reload();
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
