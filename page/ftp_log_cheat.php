<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); exit(); }


$data = ftp_log_parser("/cstrike/addons/hlguard/logs/detectionlist.txt",$_POST['filter']);

echo '
<form action="'.adresa().'" method="post">
Filter <input name="filter" type="text" size="70" />
<input type="image" align="top" src="'.$GLOBALS['acp_cesta'].'images/send_button.gif" name="Submit" value="Submit">
</form>
';

echo '<pre class="textarea"  >';
	if($data == true) {
		for($i=0;$i < count($data); $i++) {
			echo htmlentities($data[$i]) . "\n";
		}
	} else {
		echo 'Zaznam nenajdeny....';
	}
echo '</pre>';
?>
