<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }
// <div id="work-nazov">ACP Ziadosti</div>
?>

<div id="work-obsah">
<? echo '<form method="post" action="' . adresa() .'">'; ?>
<table class="tab_zoznam">
	<tbody>
	<tr>
		<th><a href="#"><span class="desc">Vymazat</span></a></th>
		<th><a href="#"><span class="desc">Datum</span></a></th>
		<th><a href="#"><span class="desc">Predmet</span></a></th>
		<th><a href="#"><span class="desc">Email</span></a></th>
		<th><a href="#"><span class="desc">IP</span></a></th>
	</tr>
	
<?
@$sql=mysql_prikaz("SELECT * FROM `".$mysql_tab_comment."` ORDER BY ok desc");
$temp=false;
while($row=mysql_fetch_assoc($sql)) 
{ 
	// get post
	$id = $_POST['id_'.$row['id'].''];	
	if($id) {
		$lol=mysql_prikaz("DELETE FROM `".$mysql_tab_comment."` WHERE id = '" . mysql_sterilize($row['id']) . "'");
		if(!$temp) {
			echo '<div class="tip">&#381;iados&#357; zmazan&aacute; !</div>';
			$temp=true;
		}
	}
	
/* 	$id = $_POST[''.$row['id'].'_delete'];
	if($id) {
		$lol=mysql_query("DELETE FROM `".$mysql_tab_comment."` WHERE id = '".$row['id']."'") or eror_log("Eror: comment(".$mysql_tab_comment."-".$row['id'].")");
	}	
	
	$id = $_POST[''.$row['id'].'_spracovane'];
	if($id) {
		$lol=mysql_query("UPDATE `".$mysql_tab_comment."` SET `ok` = '1' WHERE id = '".$row['id']."'") or eror_log("Eror: comment(".$mysql_tab_comment."-".$row['id'].")");
	} */
	//$id = $_POST[''.$row['id'].'-odpovedat'];
	
	//vypis
	if($row['id'] and $_POST['id_'.$row['id'].''] == false)	{
		if($row['ok'] == 0) {
			echo "<tr onmouseover=\"this.style.backgroundColor='#C7CCD2'\" onmouseout=\"this.style.backgroundColor='#D3D8DC'\"  >";
		} else {
			echo '<tr bgcolor="#C7CCD2">';
		}
				echo '<td class="tab_riadok" align="center" width="50" ><input name="id_'.$row['id'].'" type="checkbox" value="1"></td>';	
				echo '<td class="tab_riadok" align="center" width="100" >'. $row['cas'].'</td>';	
				echo "<td class=\"tab_riadok\" align=\"left\" width=\"350\" onclick=\"zoznam('".$row['id']."');\">". $row['predmet']."</td>";	
				echo '<td class="tab_riadok" align="center" width="100" >'. $row['email'].'</td>';	
				echo '<td class="tab_riadok" align="center" width="100" >'. $row['ip'].'</td>';	
				
		echo '</tr>';

		echo '<tr id="'.$row['id'].'" align="center" style="display: none;" ></br>';

			echo'
				<td align="center" colspan="5">
					<table border="0">
						<tr>
							<td align="center" colspan="5">
							<pre class="textarea" style="height:auto;width:650px;">'. htmlspecialchars($row['comment']) .'</pre>
							</td>	
						</tr> 	';
/* 						<tr>
							<td align="center" colspan="2">
								<form id="'.$row['id'].'-form" method="post" action="' . adresa() .'">
									<input type="submit" name="'.$row['id'].'_delete" value="DELETE"  >
								</form>	
							</td>
							<td align="center" >
								<input type="submit" name="'.$row['id'].'_spracovane" value="SPRACOVANE"  >
							</td>
							<td align="center" colspan="2">
								<input type="submit" name="'.$row['id'].'_odpovedat" value="ODPOVEDAT"  >
							</td>	
						</tr>  */
				echo'    </table>
				</td>
				';
		echo '</tr>';
		// http://cs.gecom.sk/web2/lol/acp/admins.php?id=151&25-delete=DELETE
	}	
} 
echo '<tr align="center">
		<td align="center" colspan="5"><input type="image" src="'.$acp_cesta.'images/form_delete_button.gif" value="DELETE" name="submit" /></td>
	</tr>
	</tbody>
 </table>
</form>';

?>