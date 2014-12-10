<?
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
						Stranky							
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	$page = true;
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
						Funkcie							
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
	include("inc/function.php");
	get_login();

	if (is_numeric($_POST['servers']))
	{	
		$_SESSION["servers"] = $acp_servers[$_POST['servers']]; 
	}
	
	$menu = $_GET['menu'];
	
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
						Header							
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Admin Configuration Panel</title>
	<link href="'.$acp_cesta.'acp.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="'.$acp_cesta.'inc/jquery.js"></script>
	<script src="'.$acp_cesta.'inc/javascript.js" type="text/javascript"></script>
	
	<link href="'.$acp_cesta.'images/ico.png" type="image/x-icon" rel="shortcut icon"/>
</head>
<body>
<div id="body">
	<div id="work">
';	
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
						Obsah							
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

switch($menu) {
	case false : 		$stranka = "acp_uvod.php";
						break;				

	// Ssh
	case "ssh" : 
						if(if_get_user_access(SUPER_ADMIN)) {
						$stranka = "ssh.php"; 
						break; }
	//Ftp	
	case "ftp_amx" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_amx.php"; 
						break; }			
	case "ftp_amxbans" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_amxbans.php"; 
						break; }		
	case "ftp_amxsuper" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_amxsuper.php"; 
						break; }	
	case "ftp_reklama" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_reklama.php"; 
						break; }	
	case "ftp_motd" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_motd.php"; 
						break; }	
	case "ftp_zombie_cfg" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_zombie_cfg.php"; 
						break; }	
	case "ftp_say_commands" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_say_commands.php"; 
						break; }	
	case "ftp_zombie_plugin" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_zombie_plugin.php"; 
						break; }	
	case "ftp_zombie_log" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_zombie_log.php"; 
						break; }	
	case "ftp_zombie_plugin" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_loading_music.php"; 
						break; }	
	case "ftp_hlguard" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_hlguard.php"; 
						break; }		
	case "ftp_plugins" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_plugins.php"; 
						break; }	
	case "ftp_loading_music" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_loading_music.php"; 
						break; }
	case "ftp_log_cs" : 
						if(if_get_user_access(SUPER_ADMIN)) {
						$stranka = "ftp_log_cs.php"; 
						break; }		
	case "ftp_log_amx" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_log_amx.php"; 
						break; }		
	case "ftp_log_eror" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_log_eror.php"; 
						break; }		
	case "ftp_log_chat" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_log_chat.php"; 
						break; }					
	case "ftp_log_cheat" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp_log_cheat.php"; 
						break; }
	case "ftp_mapy" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "ftp.php"; 
						break; }						
	// Mysql
	case "mysql_zombie_zoznam" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "mysql_zombie_zoznam.php"; 
						break; }
	case "mysql_zombie_global" : 
						if(if_get_user_access(SUPER_ADMIN)) {
						$stranka = "mysql_zombie_global.php"; 
						break;	}				
	case "mysql_users" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "mysql_users.php"; 
						break;	}				
	case "mysql_comment" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "mysql_comment.php"; 
						break;	}				
	case "acp_options" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "acp_options.php"; 
						break;	}				
	case "acp_logs" : 
						if(if_get_user_access(HEAD_ADMIN)) {
						$stranka = "acp_logs.php"; 
						break; }	
	case "mysql_profil" : $stranka = "mysql_profil.php";
						break;						
	default : 			
						$stranka = "acp_eror.php";
						//eror_log("No access:".$menu."");
						break;					
}

			include("page/".$stranka);
			
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
						Footer							
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
?>	
		</div>	
	</div>
	
	
	<div id="menu">
		<div id="menu-head">
			<div id="logo"> </div>
			<br>
			<a onmouseout="this.style.color='white'" onmouseover="this.style.color='red'" href="login.php?mode=logout"><img border="0" alt="" align="absmiddle" src="<? echo $acp_cesta; ?>/images/logout.png"/> Odhl&aacute;si&#357; </a>
			<a onmouseout="this.style.color='white'" onmouseover="this.style.color='green'" href="?menu=mysql_profil" style="margin-left:150px;"><img border="0" align="absmiddle" alt="" src="<? echo $acp_cesta; ?>/images/profil.png"/> Zmeni&#357; profil </a>
			<br>
		</div>	
		<div id="menu-inner">
			<div id="menu-inner-inner">
				<?	echo server(false); ?>	
				
				<div class="menu-system" >
					<div class="menu-system-left">
						<img class="menu-avatar" height="75" width="75" src="<? echo $acp_cesta; ?>/images/sicon.png" />
						<div class="menu-reset" align="center">
							<br><img onmouseout="this.src='<? echo $acp_cesta; ?>/images/reset.png'" onmouseover="this.src='<? echo $acp_cesta; ?>/images/reset2.png'" src="<? echo $acp_cesta; ?>/images/reset.png" />
						</div>
					</div>
					<div class="menu-system-right" >
						<h3>Spr&aacute;va s&uacute;borov</h3>	
							<div class="menu-popis">
								<strong>Uprava suborov teda aj<br>
										nastevenia servera,<br>
										pluginov,modulov.<br>
								</strong>
							</div>
							<div class="menu-obsah">
								<a href="?menu=ftp_server"><strong>Nastavenia Servera</strong></a><br>
								<a href="?menu=ftp_amx"><strong>Amx Mod X Config</strong></a><br>
								<a href="?menu=ftp_amxbans"><strong>Amx Bans Config</strong></a><br>
								<a href="?menu=ftp_amxsuper"><strong>Amx Super config</strong></a><br>
								<a href="?menu=ftp_motd"><strong>Uvodna obrazovka</strong></a><br>
								<a href="?menu=ftp_reklama"><strong>Reklama</strong></a><br>	
								<a href="?menu=ftp_say_commands"><strong>Udalosti na text</strong></a><br>	
								<a href="?menu=ftp_plugins"><strong>Pluginy</strong></a><br>	
								<a href="?menu=ftp_loading_music"><strong>Loading zvucky</strong></a><br>	
								<a href="?menu=ftp_hlguard"><strong>Antycheat</strong></a><br>	
	
							</div>		
					</div>
				</div>	
				
				
				<div class="menu-system" >
					<div class="menu-system-left" style="left: 0px;">
						<img class="menu-avatar" height="75" width="75" src="<? echo $acp_cesta; ?>/images/linux.png"/>
						<div class="menu-reset" align="center">
							<br><img onmouseout="this.src='<? echo $acp_cesta; ?>/images/reset.png'" onmouseover="this.src='<? echo $acp_cesta; ?>/images/reset2.png'" src="<? echo $acp_cesta; ?>/images/reset.png" />
						</div>
					</div>
					<div class="menu-system-right" >
						<h3>Server</h3>	
							<div class="menu-popis">
								<strong>Ovladanie a aktualny<br>
										stav serverov.<br>
								</strong>
							</div>
							<div class="menu-obsah">						
								<a href="?menu=ssh"><strong>SSH</strong></a><br>	
								<a href="?menu=mysql_users"><strong>U&#382;ivatelia</strong></a><br>	
								<a href="?menu=ftp_log_cs"><strong>Log CS 1.6</strong></a><br>	
								<a href="?menu=ftp_log_amx"><strong>Log Amx mod X</strong></a><br>	
								<a href="?menu=ftp_log_eror"><strong>Log Erors</strong></a><br>	
								<a href="?menu=ftp_log_chat"><strong>Log Chat</strong></a><br>	
								<a href="?menu=ftp_log_cheat"><strong>Log Cheatery</strong></a><br>	
								<a href="?menu=ftp_mapy"><strong>Mapy</strong></a><br>	
								<a href="?menu=ftp_reklama"><strong>Status</strong></a><br>	
							</div>
					</div>
				</div>					
	
				<div class="menu-system" >
					<div class="menu-system-left" >
						<img class="menu-avatar" height="75" width="75" src="<? echo $acp_cesta; ?>/images/zombie.jpg" />
						<div class="menu-reset" align="center">
							<br><img onmouseout="this.src='<? echo $acp_cesta; ?>/images/reset.png'" onmouseover="this.src='<? echo $acp_cesta; ?>/images/reset2.png'" src="<? echo $acp_cesta; ?>/images/reset.png" />
						</div>
					</div>
					<div class="menu-system-right" >
						<h3>Zombie</h3>
							<div class="menu-popis">
								<strong>Spravovanie bankovych<br>
										a vip uctov na zombie<br>
								</strong>
							</div>
							<div class="menu-obsah">
								<a href="?menu=mysql_zombie_zoznam"><strong>Banka</strong></a><br>
								<a href="?menu=mysql_zombie_global"><strong>Hromadne oper&aacute;cie</strong></a><br>
								<a href="?menu=ftp_zombie_cfg"><strong>Zombie CFG</strong></a><br>
								<a href="?menu=ftp_zombie_plugin"><strong>Zombie Pluginy</strong></a><br>
								<a href="?menu=ftp_zombie_log"><strong>Zombie Log</strong></a><br>
							</div>
					</div>
				</div>
				
				
				
				<div class="menu-system" >
					<div class="menu-system-left">
						<img class="menu-avatar" height="75" width="75" src="<? echo $acp_cesta; ?>/images/image.png" />
						<div class="menu-reset" align="center">
							<br><img onmouseout="this.src='<? echo $acp_cesta; ?>/images/reset.png'" onmouseover="this.src='<? echo $acp_cesta; ?>/images/reset2.png'" src="<? echo $acp_cesta; ?>/images/reset.png" />
						</div>
					</div>
					<div class="menu-system-right" >
						<h3>ACP Spr&aacute;vca </h3>
							<div class="menu-popis">
								<strong>Nastavenie aplikacie<br>
										a sprava ziadosti.<br>
								</strong>
							</div>
							<div class="menu-obsah">
								<a href="?menu=mysql_comment"><strong>&#381;iadosti</strong></a><br>
								<a href="?menu=acp_options"><strong>Nastavenia</strong></a><br>
								<a href="?menu=acp_logs"><strong>Logy</strong></a><br>
							</div>
					</div>	
				</div>
				
				<div class="menu-parser" align="center"> .. </div> <? // fixne ozajstnu velkost menu ?>					
			</div>		
		</div>
		<div align="center" id="stats">
			<? 
			// mysql queries
			echo  $acp_temp . " queries | ";
			// moduly
			echo "SQL ";
			
			@$hodnota = strpos( $menu , "ftp_");
			$hodnota = ($hodnota === false) ? false : true;
			if($hodnota) { echo "+ FTP "; }
			echo "modul | ";
			echo "Logs ";
			?> 
		</div>
		<pre>
		</pre>
		
	</div>
	
</div>
</body>
</html>