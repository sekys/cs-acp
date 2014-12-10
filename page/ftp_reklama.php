<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); exit(); }

echo ftp_edit_obsah("/cstrike/addons/amxmodx/configs/advertisements.ini");

?>
