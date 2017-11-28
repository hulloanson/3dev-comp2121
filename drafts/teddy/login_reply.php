<?php

		include 'database.php';
		
		if($user_id != ""){
			header( "refresh:0;url=./" );
			die;
		}
		
		$returnMessage['msg'] = "";
		
		
		  if (!isset($_POST['recaptcha_challenge_field']) || !isset($_POST['recaptcha_response_field'])) {
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid Validation Code<br>";
				echo json_encode($returnMessage);
				die ();
		  } 
		
		 require_once('recaptchalib.php');
		  $privatekey = "6LcpCAwUAAAAAPDaTZApbRyGX9uSyccS9EDouPFZ";
		  $resp = recaptcha_check_answer ($privatekey,
										$_SERVER["REMOTE_ADDR"],
										$_POST["recaptcha_challenge_field"],
										$_POST["recaptcha_response_field"]);

		  if (!$resp->is_valid) {
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid Validation Code<br>";
				echo json_encode($returnMessage);
				die ();
		  } 
		  
		$login_form_username = mysql_real_escape_string($_POST['login_form_username']);
		$login_form_password = mysql_real_escape_string($_POST['login_form_password']);
		
		
			if(strlen($login_form_username)  < 5 )
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid username or password<br>";
			else 
			if(strlen($login_form_password)  < 5 )
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid username or password<br>";
		  
			
			
			
			if ($returnMessage['msg'] == "") {
			
				$login_form_password =  md5($login_form_password);
				$query = "SELECT username FROM comp2121_login WHERE username='$login_form_username' and password ='$login_form_password'" ;

				$result=mysql_query($query);
				$num=mysql_numrows($result);

				if($num > 0){
					
					
			  $sql="UPDATE comp2121_login SET cookie = '$loginCookie' WHERE  username='$login_form_username' and password ='$login_form_password'";
				mysql_query($sql);
				
				}else{
					
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid username or password<br>";
				}
			}
			
				echo json_encode($returnMessage);
		
		
 ?>