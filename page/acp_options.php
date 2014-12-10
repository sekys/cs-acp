<?

if(!$page){ header("Location: ".$acp_cesta."login.php"); } 

echo "<div id=\"work-obsah\">";

if(if_get_user_access(SUPER_ADMIN) == true) {
	
	if($_POST['form-send']) {
		//novy server
		if($_POST['server-action-add']) 
		{

			$_POST['server-ip'];
			$_POST['server-id'];
			$_POST['server-ssh'];
			$_POST['server-name'];
			echo '<div class="tip">Server '.htmlspecialchars($_POST['server-ip'], ENT_QUOTES).' pridan&yacute; !</div>';
			// ...
		}	
		//vymazat server
		if($_POST['server-action-delete']) 
		{
			$_POST['id'];
			$_POST['server-ip'];
			$_POST['server-id'];
			$_POST['server-ssh'];
			$_POST['server-name'];
			echo '<div class="tip">Server '.htmlspecialchars($_POST['server-ip'], ENT_QUOTES).' zmazan&yacute; !</div>';
			// ...
		}	
		// upravit server
		if($_POST['server-action-delete']) 
		{
			$_POST['id'];
			$_POST['server-ip'];
			$_POST['server-id'];
			$_POST['server-ssh'];
			$_POST['server-name'];
			echo '<div class="tip">Server '.htmlspecialchars($_POST['server-ip'], ENT_QUOTES).' upraven&yacute; !</div>';
			// ...
		}		
		// Sprava MYSQL
			$text[] = "// ACP - Mysql modul";
			$text[] = "\$mysql_host = ". $_POST['mysql_host']."\";";
			$text[] = "\$mysql_uzivatel = \"".	$_POST['mysql_uzivatel']."\";";
			$text[] = "\$mysql_heslo = \"".	$_POST['mysql_heslo']."\";";
			$text[] = "\$mysql_databaza = \"".	$_POST['mysql_databaza']."\";";
			$text[] = "";
			$text[] = "\$mysql_tab_admini = \"".	$_POST['mysql_tab_admini']."\";";
			$text[] = "\$mysql_tab_adminservers = \"".	$_POST['mysql_tab_adminservers'].";";
			$text[] = "\$mysql_tab_log = \"".	$_POST['mysql_tab_log']."\";";
			$text[] = "\$mysql_tab_comment = \"".	$_POST['mysql_tab_comment']."\";";
			$text[] = "\$mysql_tab_zombie = \"".	$_POST['mysql_tab_zombie']."\";";
			$text[] = "";
			//echo '<div class="tip">Mysql &uacute;daje upraven&eacute;!</div>';
			
		// ACP
			$text[] = "// ACP - Config";
			$text[] = "\$acp_cesta = ". $_POST['acp_cesta']."\";";
			$text[] = "\$acp_log_pocet = ". $_POST['acp_log_pocet']."\";";
			$text[] = "\$acp_lock = ". $_POST['acp_lock']."\";";
			$text[] = "";		
		// Admini
			$text[] = "// ACP - Admini";
			$text[] = "define(\"SUPER_ADMIN\", \"". $_POST['SUPER_ADMIN']."\");";
			$text[] = "define(\"HEAD_ADMIN\", \"". $_POST['HEAD_ADMIN']."\");";
			$text[] = "define(\"ADMIN\", \"". $_POST['ADMIN']."\");";
			$text[] = "define(\"CHEATHUNTER\", \"". $_POST['CHEATHUNTER']."\");";
			$text[] = "define(\"VIP\", \"". $_POST['VIP']."\");";
			$text[] = "define(\"NORMAL\", \"". $_POST['NORMAL']."\");";
			$text[] = "";
			
			$text[] = "// ACP - Prava";
			$text[] = "define(\"ADMIN_IMMUNITY\", \"". $_POST['ADMIN_IMMUNITY']."\");";
			$text[] = "define(\"ADMIN_RESERVATION\", \"". $_POST['ADMIN_RESERVATION']."\");";
			$text[] = "define(\"ADMIN_KICK\", \"". $_POST['ADMIN_KICK']."\");";
			$text[] = "define(\"ADMIN_BAN\", \"". $_POST['ADMIN_BAN']."\");";
			$text[] = "define(\"ADMIN_SLAY\", \"". $_POST['ADMIN_SLAY']."\");";
			$text[] = "define(\"ADMIN_MAP\", \"". $_POST['ADMIN_MAP']."\");";
			$text[] = "define(\"ADMIN_CVAR\", \"". $_POST['ADMIN_CVAR']."\");";
			$text[] = "define(\"ADMIN_CFG\", \"". $_POST['ADMIN_CFG']."\");";
			$text[] = "define(\"ADMIN_CHAT\", \"". $_POST['ADMIN_CHAT']."\");";
			$text[] = "define(\"ADMIN_VOTE\", \"". $_POST['ADMIN_VOTE']."\");";
			$text[] = "define(\"ADMIN_SEE\", \"". $_POST['ADMIN_SEE']."\");";
			$text[] = "define(\"ADMIN_MENU\", \"". $_POST['ADMIN_MENU']."\");";
			$text[] = "";
			
		// Ftp	
			$text[] = "// ACP - Ftp";
			
		/*	$ftp_host = "10.0.1.3"; 
			$ftp_uzivatel = "cstrike";
			$ftp_heslo = "cslege";
			$ftp_sterilize = array( // Neziadane mena v suboroch
					"rcon_password",
					"sv_password",
					"rcon", 
					"heslo",
					"pass",
					"amx_addadmins",
					"amx_gamename",
					"hostname",
					"sv_password",
					) 	*/
			$text[] = "";			
		
			$data ='<? if(!$page){ header("Location: ".$acp_cesta."login.php"); } ';
			for($i=0; $i < count($text); $i++) {
				$data .= $text[$i] . '\n';
			}
			$data .='?>';
			vloz_subor($acp_cesta . "/inc/config.inc.php",$data);
	}	
	// Echo
} else {
	die("<div class=\"tip\">Nemo&#382;e&scaron; upravova&#357; &uacute;daje!</div>");
}
echo '
<table width="800" border="0" class="tab_zoznam">
  	<tbody>
	<tr>
		<td  colspan="12" class="listtable_top"><b>Servery :</b></td>
	</tr>
	<tr bgcolor="#D3D8DC">
		<td class="tab_riadok">#</td>
		<td class="tab_riadok">IP Adresa</td>
		<td class="tab_riadok">ID Cislo</td>
		<td class="tab_riadok">SSH Adresa</td>
		<td class="tab_riadok">Meno</td>
		<td class="tab_riadok">Akcia</td>
	</tr>';
		
for($b=0; $b < count($acp_servers); $b++) {
	$i = $b + 1;
	echo'<form name="servers" method="post" action="'.adresa().'">'; //
	echo '<tr bgcolor="#D3D8DC">
	    <td width="5%" ><div align="center">'.$i.'<input type="hidden" name="id" value="'.$b.'"></div></td>
	    <td width="20%" align="center" class="tab_riadok"><input type="text" size="15" name="server-ip" value="'.$acp_servers[$b][0].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    <td width="20%" align="center" class="tab_riadok"><input size="3" type="text" name="server-id" value="'.$acp_servers[$b][1].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    <td width="20%" align="center" class="tab_riadok"><input size="40" type="text" name="server-ssh" value="'.$acp_servers[$b][2].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    <td width="20%" align="center" class="tab_riadok"><input size="20" type="text" name="server-name-" value="'.$acp_servers[$b][3].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
		<td width="20%" align="right" class="tab_riadok" ><input type="image" src="'.$acp_cesta.'images/edit_button.gif" name="server-action-edit" value="upravit" style="font-family: verdana, tahoma, arial; font-size: 10px"><input type="image" src="'.$acp_cesta.'images/delete_button.gif" name="server-action-delete" value="delete" style="font-family: verdana, tahoma, arial; font-size: 10px" ></td>
	 </tr>
	</form> ';
} 
//dalej
$i=$i+1;
echo'<form name="servers" method="post" action="'.adresa().'">'; //
echo '
	<tr bgcolor="#D3D8DC">
	    <td width="5%" ><div align="center">'.$i.'</div></td>
	    <td width="20%" align="center" class="tab_riadok"><input type="text" size="15" name="server-ip" value="Prida&#357; server..." style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    <td width="20%" align="center" class="tab_riadok"><input size="3" type="text" name="server-id" value="0" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    <td width="20%" align="center" class="tab_riadok"><input size="40" type="text" name="server-ssh" value="" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    <td width="20%" align="center" class="tab_riadok"><input size="20" type="text" name="server-name" value="" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
		<td width="20%" align="right" class="tab_riadok" ><input type="image" src="'.$acp_cesta.'images/add_button.gif" name="server-action-add" value="upravit" style="font-family: verdana, tahoma, arial; font-size: 10px"></td>
	 </tr>
	 </form> 
	<tr>
		<td  colspan="12" class="listtable_top"><b>Mysql &uacute;daje :</b></td>
	</tr>
	<tr bgcolor="#D3D8DC">
		<td class="tab_riadok" colspan="2">&Uacute;daj</td>
		<td class="tab_riadok" colspan="1">Hodnota</td>		
		<td class="tab_riadok" colspan="1">N&aacute;zov</td>
		<td class="tab_riadok" colspan="1">N&aacute;zov tabu&#318;ky</td>
	</tr>
<form name="config" id="config" method="post" action="'.adresa().'">
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">mysql_host</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_host" value="'.$mysql_host.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">mysql_tab_admini</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_tab_admini" value="'.$mysql_tab_admini.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>		
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">mysql_uzivatel</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_uzivatel" value="***" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    
		<td align="center" class="tab_riadok" colspan="1">mysql_tab_adminservers</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_tab_adminservers" value="'.$mysql_tab_adminservers.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>		
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">mysql_heslo</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_heslo" value="***" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	    
		<td align="center" class="tab_riadok" colspan="1">mysql_tab_log</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_tab_log" value="'.$mysql_tab_log.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">mysql_databaza</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_databaza" value="'.$mysql_databaza.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">mysql_tab_comment</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_tab_comment" value="'.$mysql_tab_comment.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">
	</td>
	    <td align="center" class="tab_riadok" colspan="1"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">mysql_tab_zombie</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="mysql_tab_zombie" value="'.$mysql_tab_zombie.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	
	<tr>
		<td  colspan="12" class="listtable_top"><b>ACP config :</b></td>
	</tr>
	<tr bgcolor="#D3D8DC">
		<td class="tab_riadok" colspan="2">N&aacute;zov</td>
		<td class="tab_riadok" colspan="1">Hodnota</td>		
		<td class="tab_riadok" colspan="1">N&aacute;zov</td>
		<td class="tab_riadok" colspan="1">Hodnota</td>
	</tr>
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">acp_cesta</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="acp-acp_cesta" value="'.$acp_cesta.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">acp_log_pocet</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="acp-acp_log_pocet" value="'.$acp_log_pocet.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">acp_lock</td>
	    <td align="center" class="tab_riadok" colspan="1"><input name="acp-acp_lock" type="checkbox"  value="true" style="font-family: verdana, tahoma, arial; font-size: 10px;"';
		if($acp_lock) { echo 'checked'; }
echo '></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">acp_lock</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="acp-acp_log_pocet" value="'.$acp_log_pocet.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>
	
	
	<tr>
		<td  colspan="12" class="listtable_top"><b>Admin prava :</b></td>
	</tr>
	<tr bgcolor="#D3D8DC">
		<td class="tab_riadok" colspan="2">Skupina</td>
		<td class="tab_riadok" colspan="1">Ozna&#269;enie</td>		
		<td class="tab_riadok" colspan="1">N&aacute;zov</td>
		<td class="tab_riadok" colspan="1">Pr&iacute;stup</td>
	</tr>
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">Super admin</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="SUPER_ADMIN" value="'. SUPER_ADMIN .'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Imunita</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_IMMUNITY" value="'.ADMIN_IMMUNITY.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">Head admin</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="HEAD_ADMIN" value="'. HEAD_ADMIN.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Rezervevacia</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_RESERVATION" value="'.ADMIN_RESERVATION.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">Admin</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN" value="'. ADMIN.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Kick</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_KICK" value="'.ADMIN_KICK.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">Cheathunter</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="CHEATHUNTER" value="'. CHEATHUNTER.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Ban</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_BAN" value="'.ADMIN_BAN.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">Reklamator</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="REKLAMATOR" value="'. REKLAMATOR.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Slay / Slap</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_SLAY" value="'.ADMIN_SLAY.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">VIP</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="VIP" value="'. VIP .'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Mapy</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_MAP" value="'.ADMIN_MAP.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2">Normal</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="NORMAL" value="'. NORMAL .'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Cvar</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_CVAR" value="'.ADMIN_CVAR.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2"></td>
	    <td align="center" class="tab_riadok" colspan="1"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Cfg</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_CFG" value="'.ADMIN_CFG.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2"></td>
	    <td align="center" class="tab_riadok" colspan="1"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Chat</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_CHAT" value="'.ADMIN_CHAT.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2"></td>
	    <td align="center" class="tab_riadok" colspan="1"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Hlasovanie</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_VOTE" value="'.ADMIN_VOTE.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2"></td>
	    <td align="center" class="tab_riadok" colspan="1"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">/admin</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_SEE" value="'.ADMIN_SEE.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>	
	<tr bgcolor="#D3D8DC">
	    <td align="center" class="tab_riadok" colspan="2"></td>
	    <td align="center" class="tab_riadok" colspan="1"></td>
	   
	   <td align="center" class="tab_riadok" colspan="1">Menu</td>
	    <td align="center" class="tab_riadok" colspan="1"><input size="40" type="text" name="ADMIN_MENU" value="'.ADMIN_MENU.'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
	</tr>
	<tr>
		<td  colspan="5" class="listtable_top" align="center"><input type="image" src="'.$acp_cesta.'images/send_button.gif" name="form-send" style="font-family: verdana, tahoma, arial; font-size: 10px"></td>
	</tr>
</form>		
	</tbody>
</table>';





/* 


print_r($acp_servers);


echo "- Mysql<br>";
echo $mysql_databaza . "<br>";
echo $mysql_tab_admini . "<br>";
echo $mysql_tab_log . "<br>";
echo $mysql_tab_comment . "<br>";
echo $mysql_tab_zombie . "<br>";

echo "- ACP<br>";
echo $acp_cesta . "<br>";
echo $acp_log_pocet . "<br>";

echo "- Admin<br>";
echo SUPER_ADMIN . "<br>";
echo HEAD_ADMIN . "<br>";
echo ADMIN . "<br>";
echo CHEATHUNTER . "<br>";
echo REKLAMATOR . "<br>";

echo "- Sesion server:<br>";
print_r($_SESSION["servers"]) . "<br>";

echo "- Sesion info:<br>";
print_r($_SESSION["info"]) . "<br>";
echo "</pre>";

 */
 

?>
