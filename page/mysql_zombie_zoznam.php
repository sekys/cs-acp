<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }


$delete = $_POST['delete-meno'];
$name = $_POST['name'];
$add = $_POST['add'];

//if(if_get_user_access(SUPER_ADMIN) == true) {
	if($delete) {
		@$sql=mysql_prikaz("DELETE FROM `".$mysql_tab_zombie."` WHERE auth = '".$delete."'");
		echo '<div class="tip">Ucet '.htmlspecialchars($delete, ENT_QUOTES).' zmazany !</div>';
	} elseif($name) {

		$pass = $_POST['pass'];
		$amount = $_POST['amount'];
		$vip = ($_POST['vip']) ? 1 : 0;
		@$sql=mysql_prikaz("UPDATE `".$mysql_tab_zombie."` SET `auth` = '".$name."',`pass`='".$pass."',`amount`='".$amount."',`vip`='".$vip."' WHERE auth = '".$name."'");
		echo '<div class="tip">Ucet '.htmlspecialchars($name, ENT_QUOTES).' upraveny !</div>';
		// UPDATE `acp_comment` SET `email`= 'lol@cen.sk',`predmet`='2' WHERE `email`= 'lol@cen.sk'
	}	
	//add
	if($add) {
		$pass = $_POST['pass'];
		$amount = $_POST['amount'];
		$vip = ($_POST['vip']) ? 1 : 0;
		@$sql=mysql_prikaz("INSERT INTO `" . $mysql_tab_zombie . "` (auth, pass, amount, vip) values('" . $add . "','" . $pass . "','" . $amount . "','" . $vip . "')");
		echo '<div class="tip">Ucet '.htmlspecialchars($add, ENT_QUOTES).' vytvoreny !</div>';
		// UPDATE `acp_comment` SET `email`= 'lol@cen.sk',`predmet`='2' WHERE `email`= 'lol@cen.sk'
	}
	
//} else {
//	echo "<div class=\"tip\">Nemo&#382;e&scaron; upravova&#357; &uacute;daje!</div>";
//}
//normal
echo '<table class="tab_zoznam" style="width:600px;">
		<tr>
			<td  colspan="12" class="listtable_top"><b>Zombie zoznam &uacute;&#269;tov :</b></td>
		</tr>
	<tr bgcolor="#D3D8DC">
		<td class="tab_riadok">Zmaza&#357;</td>
		<td class="tab_riadok">Meno</td>
		<td class="tab_riadok">Heslo</td>
		<td class="tab_riadok">Bodov</td>
		<td class="tab_riadok">VIP</td>
		<td class="tab_riadok">Akcia</td>
	</tr>';


@$sql=mysql_prikaz("SELECT * FROM `".$mysql_tab_zombie."` ORDER BY amount desc");
while($row=mysql_fetch_assoc($sql)) 
{ 
	// statisiky
	$zaznamov++;
	count($row);
	if($row['amount'] <= 5) { $neaktivnych++; }
	$bodov = $bodov + $row['amount'];
	//-----------------
	echo '<tr bgcolor="#D3D8DC">';
	//delete
		echo '<td class="tab_riadok">';
		echo '<form id="del-form" method="post" action="' . adresa() .'">';
		echo '<input name="delete-meno" type="hidden" value="'.$row['auth'].'" />';
		echo '<input type="image" src="'.$acp_cesta.'images/delete_button.gif" name="Submit" value="DELETE" />';
		echo '</form>';
		echo '</td>';
	//normal	
		echo '<form id="form" method="post" action="' . adresa().'">';
			echo '<td class="tab_riadok">';
				echo "<input name=\"name\" type=\"text\" value=\"".  $row['auth'] ."\" size=\"40\" style=\"font-family: verdana, tahoma, arial; font-size: 10px;\"/>";
			echo '</td>';
			echo '<td class="tab_riadok">';
				echo "<input name=\"pass\" type=\"text\" value=\"";
					//if(if_get_user_access(SUPER_ADMIN) == false) {
					//	echo "****";
					//} else {
						echo $row['pass'];
					//}
				echo "\" size=\"20\" style=\"font-family: verdana, tahoma, arial; font-size: 10px;\"/>";		
			echo '</td>';
			echo '<td class="tab_riadok">';
				echo "<input name=\"amount\" type=\"text\" value=\"".  $row['amount'] ."\" size=\"10\" style=\"font-family: verdana, tahoma, arial; font-size: 10px;\"/>";
			echo '</td>';
			echo '<td class="tab_riadok">';
		//vip	
				if($row['vip']==1) { $check = "checked=\"checked\""; } else { $check = ""; } echo '<input '.$check.' type="checkbox" name="vip" value="true" />';
			echo '</td>';
			echo '<td class="tab_riadok">';
				echo '<input type="image" src="'.$acp_cesta.'images/update_button.gif" name="Submit" value="ok" />';
			echo '</td>';
		echo '</form>';
		
	echo '</tr>';
} 
// uzavrieme cyklus

	echo '<tr bgcolor="#D3D8DC">';
	//add
		echo '<form id="add-form" method="post" action="' . adresa() .'">';
		echo '<td class="tab_riadok">';
		echo '<input type="image" src="'.$acp_cesta.'images/add_button.gif" name="Submit" value="add" />';
		echo '</td>';
	//normal	
			echo '<td class="tab_riadok">';
				echo "<input name=\"add\" type=\"text\" value=\"".  $row['auth'] ."\" size=\"40\" style=\"font-family: verdana, tahoma, arial; font-size: 10px;\"/>";
			echo '</td>';
			echo '<td class="tab_riadok">';
				echo "<input name=\"pass\" type=\"text\" value=\"";
				echo "\" size=\"20\" style=\"font-family: verdana, tahoma, arial; font-size: 10px;\"/>";		
			echo '</td>';
			echo '<td class="tab_riadok">';
				echo "<input name=\"amount\" type=\"text\" value=\"0\" size=\"10\" style=\"font-family: verdana, tahoma, arial; font-size: 10px;\"/>";
			echo '</td>';
			echo '<td class="tab_riadok">';
		//vip	
			echo '<input type="checkbox" name="vip" value="true" />';
			echo '</td>';
			echo '<td class="tab_riadok">';
				echo '<input type="image" src="'.$acp_cesta.'images/add_button.gif" name="Submit" value="add" />';
			echo '</td>';
		echo '</form>';
		
	echo '</tr>';
	$priemer =  round( $bodov / $zaznamov);
	echo '<tr>
			<td  colspan="12" class="listtable_top" align="center"><b>Z&aacute;znamov '.$zaznamov.' - Neakt&iacute;vnych &uacute;&#269;tov '.$neaktivnych.' - Spolu bodov '.$bodov.' - Priemerne bodov '.$priemer.' </b></td>
		</tr>
	</table>';
?>