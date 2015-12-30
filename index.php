<?php

	include_once("inc/facebook.php"); //include facebook SDK
	/*------------- Facebook API Configuration ----------------*/
	$appId = '433089193554285'; //Facebook App ID
	$appSecret = '1d310ff21386820d2010b66345c5f637'; // Facebook App Secret
	$homeurl = 'http://f5buddyprojects.com/facebooklogin/';  //return to home
	$fbPermissions = 'email';  //Required facebook permissions
	/*------------- Facebook API Configuration end ----------------*/


	//Call Facebook API
	$facebook = new Facebook(array(
	  'appId'  => $appId,
	  'secret' => $appSecret
	));
	$fbuser = $facebook->getUser();


	if(!$fbuser){
		$fbuser = null;
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
		$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
	}else{
		$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
		print_r($user_profile);
		
		$output = '<h1>Facebook Profile Details </h1>';
	    $output .= '<br/>Logout from <a href="logout.php?logout">Facebook</a>'; 
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Login with Facebook using PHP by CodexWorld</title>
		
		<style type="text/css">
			h1{font-family:Arial, Helvetica, sans-serif;color:#999999;}
		</style>
	</head>
	<body>
		<div>
			<?php echo $output; ?>
		</div>
	</body>
</html>