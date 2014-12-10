<?
$page = true;
include("inc/function.php");

if($_GET['mode'] == "logout" ) {
	session_unset();
	session_destroy();
	$vysledok = "Uspesne odhlaseny.";
} elseif($_GET['mode'] == true)	{
	$vysledok = $_GET['mode'];
} else {
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	if($user and $pass) {

			$user = mysql_sterilize($user);
			$pristup = mysql_user_get($user);
			if($pristup) {
				if($pass == $pristup['password']) {	
					if($acp_lock == true) {
						if(if_get_user_access(SUPER_ADMIN,$pristup[3])) {
							set_login($pristup);
							header("Location: ".$acp_cesta."acp.php");	
						} else {
							$vysledok = "Spr&aacute;vca uzamkol ACP !";
						}
					} else {			
						set_login($pristup);
						header("Location: ".$acp_cesta."acp.php");			
					}
				} else {
					$vysledok = "Nespravn&eacute; heslo !";	
				}
			} else {
				$vysledok = "Nepovolen&yacute; pr&iacute;stup !";
			}
			
	} else {
	 $vysledok = "..................";
	}	
}
//print_r($_SESSION["info"]) . "<br>";   debug
?>
<style type="text/css">
<!--
body {
	background-color: #000000;
}
.header {
	background-image: url(images/header.png);
	height: 142px;
	width: 404px;
}
.acp {
	background-image: url(images/acp.png);
	height: 300px;
	width: 600px;
}
#credits {
	padding: 50px;
}
#login {
	width: 150px;
	color: #666666;
	padding-left:160px;
	padding-top:70px;
}
.login-form {
	border-color: #999999;
}
-->
</style>

<div align="center">
<div class="header"> </div>
<div class="acp"> 
<form action="login.php" method="post">
	<div align="center" id="login">Administrator:<br>
	<input name="user" id="user" value="<? echo $user; ?>"type="text" />
	<br>
	Heslo:<br>
	<input type="password" name="pass" id="pass" class="login-form" />
	<br>
	<pre><? echo $vysledok; ?></pre>
	<input name="Submit" type="submit" value="Enter" />
	</div>
</form>	
</div>
<div align="right"  id="credits" >
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="87" height="16">
	         <param name="BGCOLOR" value="#000000" />
	          <param name="movie" value="images/credit.swf" />
	          <param name="quality" value="high" />
	          <embed src="images/credit.swf" width="87" height="16" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" bgcolor="#000000" ></embed>
</object>
  </div>	
</div>