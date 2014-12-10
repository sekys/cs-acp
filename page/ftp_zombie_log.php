<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }

$temp = $_SESSION["servers"];
$_SESSION["servers"] = $acp_servers[2];
$data = ftp_log_parser("/cstrike/addons/amxmodx/logs/zombieplague.log",$_POST['filter']);

echo '
<form action="'.adresa().'" method="post">
Filter <input name="filter" type="text" size="70" />
<input type="image" align="top" src="'.$GLOBALS['acp_cesta'].'images/send_button.gif" name="Submit" value="Submit">
</form>
';

echo '<pre class="textarea" style=" height: 650px;" >';
	if($data == true) {
		for($i=0;$i < count($data); $i++) {
			echo htmlentities($data[$i]) . "\n";
		}
	} else {
		echo 'Zaznam nenajdeny....';
	}
echo '</pre>';
$_SESSION["servers"] = $temp;
?>
