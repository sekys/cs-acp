<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }

// Kontrola suboru ,proti hacku
if($_POST['datum']) {
	$temp = explode(".",$_POST['datum']);
	$datum = is_numeric($temp[0]) ? $_POST['datum'] : date('Y.m.d');	
} else {
	$datum = date('Y.m.d');
}

$cesta = '/cstrike/addons/amxmodx/logs/'.$datum.'.htm';	
$data = ftp_log_parser($cesta,$_POST['filter']);

echo '
<form action="'.adresa().'" method="post">
Zaznam <input type="text" name="datum" id="datum" value="'.$datum.'"/>
Filter <input name="filter" type="text" value="'.$_POST['filter'].'" size="70" />
<input type="image" align="top" src="'.$acp_cesta.'images/send_button.gif" name="Submit" value="Submit">
</form>
';
// style="width:725px;"
echo '<pre class="textarea" >';
	if($data == true) {
		for($i=0;$i < count($data); $i++) {
			echo $data[$i];
		}
	} else {
		echo 'Zaznam nenajdeny....<br>';
		echo '<br>';
		echo 'Dovod:<br>';
		echo 'System nemohol najst uvedeny subor,<br>';
		echo 'skontrolujte prosim nastavenia servera<br>';
		echo 'alebo meno zaznamu ,respektive datum.<br>';
	}
echo '</pre>';

?>
