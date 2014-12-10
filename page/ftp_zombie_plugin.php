<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }

$temp = $_SESSION["servers"];
$_SESSION["servers"] = $acp_servers[2];
echo ftp_edit_obsah("/cstrike/addons/amxmodx/configs/plugins-zplague.ini");
$_SESSION["servers"] = $temp;
?>
