<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }

echo '<div id="work-nazov">ACP Z&aacute;znam udalosti</div>
<div id="work-obsah">';
$i=0;
while($_SESSION["log"][$i]) {
	echo $_SESSION["log"][$i];
	$i++;
}
?>