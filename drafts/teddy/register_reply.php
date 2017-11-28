<?php

		include 'database.php';
		
		if($user_id != ""){
			header( "refresh:0;url=./" );
			die;
		}
		
		$returnMessage['msg'] = "";
		
		  
		$register_form_firstName = mysql_real_escape_string($_POST['register_form_firstName']);
		$register_form_lastName = mysql_real_escape_string($_POST['register_form_lastName']);
		
		$register_form_password = mysql_real_escape_string($_POST['register_form_password']);
		$register_form_cpassword = mysql_real_escape_string($_POST['register_form_cpassword']);
		$register_form_email = mysql_real_escape_string($_POST['register_form_email']);
		
		$register_form_username = mysql_real_escape_string($_POST['register_form_username']);
		$register_form_gender = mysql_real_escape_string($_POST['register_form_gender']);
		$register_form_address = mysql_real_escape_string($_POST['register_form_address']);
		$register_form_phone = mysql_real_escape_string($_POST['register_form_phone']);
		$temp = mysql_real_escape_string($_POST['register_form_birth']);
		$register_form_birth = date('Y-m-d', strtotime($temp));
		
			if(strlen($register_form_username)  < 5)
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> UserName is too short (Accept 5 - 20 characters)<br>";
		  
if (preg_match('/^[-a-zA-Z0-9 .]+$/', $register_form_username)  || empty($register_form_username)){
}else{ 
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> UserName cannot contain special characters <br>";
}
		  
		  
			if($returnMessage['msg'] == ""){
				$query = "SELECT username FROM comp2121_login WHERE username='".$register_form_username."'" ;
				$result=mysql_query($query);
				$num=mysql_numrows($result);
				if($num > 0){
							  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> This username already register<br>";
				}
			}
			
			
			if(strlen($register_form_password)  < 5)
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Password is too short (Accept 5 - 30 characters)<br>";
			if($register_form_password != $register_form_cpassword  )
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Password and confirm password not equal<br>";
		  
		  
			if(strlen($register_form_firstName)  < 1)
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid first name<br>";
			if(strlen($register_form_lastName)  < 1)
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid last name<br>";
			
			if (!filter_var($register_form_email, FILTER_VALIDATE_EMAIL)) 
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid email format<br>";
			if(strlen($register_form_phone)  > 0 && strlen($register_form_phone)  < 8  )
			  $returnMessage['msg'] .= "<i class='fa fa-exclamation-circle'></i> Invalid phone number<br>";
			
			
			
			if($returnMessage['msg'] == ""){
				
				$register_form_password =  md5($register_form_password);
				
			
			  $sql="INSERT INTO comp2121_login (email, password, cookie, lastName,firstName, username, gender, address,phone, birth) 
			  VALUES ('$register_form_email','$register_form_password','$loginCookie','$register_form_lastName',
			  '$register_form_firstName', '$register_form_username', '$register_form_gender', '$register_form_address', 
			  '$register_form_phone', '$register_form_birth' )";

				
				mysql_query($sql);
				
			  
		
	
			}
				echo json_encode($returnMessage);
		
		
 ?>