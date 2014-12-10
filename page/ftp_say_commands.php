<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }

echo ftp_edit_obsah("/cstrike/addons/amxmodx/configs/say_commands.ini");

?>
