<?php


function getGUID(){
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $uuid = substr($charid, 0, 32);
        return $uuid;
    
}

date_default_timezone_set('Asia/Hong_Kong');

$db_host = "mysql.comp.polyu.edu.hk";
$db_user = "13067811d";
$db_pass = "yceynlcs";
$db_name = "13067811d";
$db_link = mysql_pconnect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $db_link);


$loginCookie = '';
if(isset($_COOKIE['loginCookie'])) 
$loginCookie = $_COOKIE['loginCookie'];
$loginCookie = mysql_real_escape_string($loginCookie);

if($loginCookie == '' || strlen($loginCookie) != 32){
	$loginCookie = getGUID();
	setcookie('loginCookie', $loginCookie, strtotime('+10 years', time()), "/");
}

$query = "SELECT * FROM comp2121_login WHERE cookie='$loginCookie'";

$result=mysql_query($query);
if(mysql_numrows($result) > 0){	
	$user_id = mysql_result($result,0,"id");
	$user_name = mysql_result($result,0,"lastName")." ".mysql_result($result,0,"firstName");
	$user_username = mysql_result($result,0,"username");
	$user_gender = mysql_result($result,0,"gender");
	$user_address = mysql_result($result,0,"address");
	$user_phone = mysql_result($result,0,"phone");
    $user_birth = date_create(mysql_result($result,0,"birth"));
	$user_email = mysql_result($result,0,"email");
	$user_lastName =  mysql_result($result,0,"lastName");
	$user_firstName =  mysql_result($result,0,"firstName");

}else{
	$user_id = "";
}
?>