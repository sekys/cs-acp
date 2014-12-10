<?
if(!$page){ header("Location: ".$acp_cesta."login.php");  }

// Kontrola suboru ,proti hacku
if($_POST['datum']) {
	$temp = explode(".",$_POST['datum']);
	$datum = is_numeric($temp[0]) ? $_POST['datum'] : date('Y.m.d');	
} else {
	$datum = date('Y.m.d');
}
// Vypis zlozky
//	03 14 023
echo "<pre>";
print_r( ftp_zlozka("./".$_SESSION["servers"][2]."/cstrike/logs", false) ); 
echo "</pre>";
// Ftp
$cesta = '/cstrike/L' . eregi_replace(".", "", $datum) . '.log';	
$data = ftp_log_parser($cesta,$_POST['filter']);

echo '
<form action="'.adresa().'" method="post">
Zaznam <input type="text" name="datum" id="datum" value="'.$datum.'"/>
Filter <input name="filter" type="text" value="'.$_POST['filter'].'" size="70" />
<input type="image" align="top" src="'.$acp_cesta.'images/send_button.gif" name="Submit" value="Submit">
</form>
';
// style="width:725px;"
echo '<pre class="textarea"  >';
	if($data == true) {
		for($i=0;$i < count($data); $i++) {
			echo $data[$i];
		}
	} else {
		echo 'Zaznam nenajdeny....<br>';
		echo '<br>';
		echo 'Dovod:';
		echo 'System nemohol najst uvedeny subor,<br>';
		echo 'skontrolujte prosim nastavenia servera<br>';
		echo 'alebo meno zaznamu ,respektive datum.<br>';
	}
echo '</pre>';

?>
