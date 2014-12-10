<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }


If($_SESSION["info"][2] == $_POST['pass']) {

	//$email = sterilize($_POST['email']);
	//$sql = mysql_query("UPDATE `".$mysql_tab_admini."` SET `steamid` = '".$email."' WHERE id = '".$_SESSION["nick"]."'") or eror_log("Eror: profil(".$_SESSION["nick"].")");
	
	//if($_POST['nheslo'] and $_POST['nheslo'] == $_POST['zheslo']) {
		//$sql = mysql_query("UPDATE `".$mysql_tab_admini."` SET `password` = '".$_POST['zheslo']."' WHERE id = '".$_SESSION["nick"]."'") or eror_log("Eror: profil(".$_SESSION["nick"].")");


	$password = ($_POST['nheslo'] and $_POST['nheslo'] == $_POST['zheslo']) ? $_POST['zheslo'] : false;
	echo mysql_user_set($_SESSION["info"][0] ,false, $password, false, false, $_POST['email'], false);
	$tip ="Profil aktualizovan&yacute; !";

} else {
	$tip ="Pre upravu profilu musis zadat stare heslo!";
}
?>
<div id="work-nazov"></div>
<div id="work-obsah">
<div class="tip"><? echo $tip; ?></div>
<form action="<? echo $acp_cesta; ?>admins.php?menu=profil" method="post">
<table width="300" border="0">
  <tr>
    <td><div align="right">Nick / Meno :</div></td>
    <td><input name="nick" type="text" readonly value="<? echo $_SESSION["info"][1]; ?>"></td>
  </tr>
  <tr>
    <td><div align="right">Stare heslo :</div></td>
    <td><input name="pass" type="text" value=""></td>
  </tr>
  <tr>
    <td><div align="right">ICQ / Email :</div></td>
    <td><input name="email" type="text" value="<? echo $_SESSION["info"][5]; ?>"></td>
  </tr>
   <tr>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right">Nove heslo :</div></td>
    <td><input name="nheslo" type="text" value=""></td>
  </tr>
  <tr>
    <td><div align="right">Znova heslo :</div></td>
    <td><input name="zheslo" type="text" value=""></td>
  </tr>
      <tr>
    <td><div align="right"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
     <td><div align="right"></div></td>
     <td><input type="image" src="<? echo $acp_cesta; ?>images/send_button.gif" name="Submit" value="Submit"></td>
  </tr>	
</table>
</form>	
