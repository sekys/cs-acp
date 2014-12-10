<?
if(!$page){ header("Location: ".$acp_cesta."login.php"); }


//$tip = "Len HeadAdmin moze spravovat adminov!";
// nepotrebuje do cyklu lebovykonavame operaciu len na 1
// potrebujeme ID ak necheme hidden


$id = $_POST['id'];
if(if_get_user_access(SUPER_ADMIN) == false and $id === 1) 
{ 
	header("Location: ".$acp_cesta."login.php"); 
	exit();
}

if( $_POST['action'] == "delete" ) //vykovame delete
{
	mysql_prikaz("DELETE FROM `".$mysql_tab_admini."` WHERE id = '".mysql_sterilize($id)."'");
	echo '<div class="tip">Admin '.$_POST['username'].' zmazany !</div>';
} elseif ( $_POST['action']=="add"  or  $_POST['action']=="upravit") {
	//if( if_get_user_access(SUPER_ADMIN )) {
		$access = $_POST['access'];	
			if($access != $_POST['access2'] ) { //nieje rovnake cize bola zmena
				if(if_get_user_access(SUPER_ADMIN,$access) or if_get_user_access(HEAD_ADMIN,$access) or if_get_user_access(VIP,$access)) { //ci neobsahuje zle znamienka a neje super admin
					if(!if_get_user_access(SUPER_ADMIN)) {
						echo '<div class="tip">Nemozes zadat take pismenko!</div>';
						$access = $row['access']; //povodne
					} 	
				}			
			} else {
				$access = ''; //dokopy
				$access .= ($_POST['a']) ? ADMIN_IMMUNITY : "";
				$access .= ($_POST['b']) ? ADMIN_RESERVATION : "";
				$access .= ($_POST['c']) ? ADMIN_KICK : "";
				$access .= ($_POST['d']) ? ADMIN_BAN : "";
				$access .= ($_POST['e']) ? ADMIN_SLAY : "";
				$access .= ($_POST['f']) ? ADMIN_MAP : "";
				$access .= ($_POST['g']) ? ADMIN_CVAR : "";
				$access .= ($_POST['h']) ? ADMIN_CFG : "";
				$access .= ($_POST['i']) ? ADMIN_CHAT : "";
				$access .= ($_POST['j']) ? ADMIN_VOTE : "";
				$access .= ($_POST['s']) ? ADMIN_SEE : "";
				$access .= ($_POST['u']) ? ADMIN_MENU : "";

				$access .= ($_POST['n']) ? ADMIN : "";
				$access .= ($_POST['o']) ? CHEATHUNTER : "";
				$access .= ($_POST['p']) ? REKLAMATOR : "";
				if(if_get_user_access(SUPER_ADMIN)) {
					$access .= ($_POST['r']) ? VIP : "";
				}	
				$access .= ($_POST['z']) ? NORMAL : "";
			}	
			// add	
			$username = $_POST['username'];
			if( $_POST['action']=="add" ) {
				$id=false;
				echo '<div class="tip">Admin '.$_POST['username'].' vytvoreny !</div>';
			} else {				
				echo '<div class="tip">Admin '.$_POST['username'].' upraveny !</div>';
			};
			echo mysql_user_set($id ,$username, $_POST['password'], $access, $_POST['flags'], $_POST['steamid'], $_POST['nickname']);		
	//}
}


//<div class="tip">'.$tip.'</div>
echo '
	<table cellspacing="1" class="tab_zoznam" width="800px">
		<tbody>
			<tr>
				<td  colspan="12" class="listtable_top"><b>Uzivatelia, admini, vip...</b></td>

			</tr>
			<tr bgcolor="#D3D8DC">
				<td class="tab_riadok">Poradie</td>
				<td class="tab_riadok">Meno</td>
				<td class="tab_riadok" align="center">Server</td>
				<td class="tab_riadok">Akcia</td>
			</tr>';
	//admini
	@$sql=mysql_prikaz("SELECT * FROM `".$mysql_tab_admini."` ORDER BY access asc");
	$poradie = 0;
	// admin na servery
	//musi byt mimo cyklu
	@$lol = mysql_prikaz("SELECT admin_id FROM `".$mysql_tab_adminservers."` WHERE server_id = '".$_SESSION["servers"][1]."'");
	while($serverid=mysql_fetch_assoc($lol)) { //cyklus pre mysql
		$data[] = $serverid['admin_id'];						
	}

while($row=mysql_fetch_assoc($sql)) 
	{	
	if( (if_get_user_access(SUPER_ADMIN,$row['access'])==false and if_get_user_access(HEAD_ADMIN,$row['access'])==false) or if_get_user_access(SUPER_ADMIN) == true   )
	{
	$poradie++;
		// echo
 			echo'<form name="admin" method="post" action="'.adresa().'">';
			if(if_get_user_access(VIP,$row['steamid']) == true) {
				echo	"<tr bgcolor=\"#f8bf7a\" >";
			} else {
				echo	"<tr bgcolor=\"#D3D8DC\" >";
			}
			echo "		
						<td width=\"8%\" onclick=\"zoznam('".$row['id']."');\" class=\"tab_riadok\" align=\"center\">".$poradie.".</td>
						<td width=\"22%\" onclick=\"zoznam('".$row['id']."');\" class=\"tab_riadok\" align=\"center\">
							<input type=\"hidden\" name=\"id\" value=\"".$row['id']."\">
							<input size=\"50\" type=\"text\" name=\"username\" value=\"".$row['username']."\" style=\"font-family: verdana, tahoma, arial; font-size: 10px; width: 140px\">
						</td>	
						<td width=\"50%\" onclick=\"zoznam('".$row['id']."');\" class=\"tab_riadok\" align=\"center\">";
						//for($b=0; $b < count($acp_servers); $b++) {//pre servery											
							echo ' <label> '.$_SESSION["servers"][3].' <input type="checkbox" name="server-'.$_SESSION["servers"][1].'"  ';
								for($i=0; $i < count($data) ; $i++)	{ // udaje z mysql v data
									if( $data[$i] == $row['id'] ) {  // ide o toho admina
										echo 'checked';													
									}
								}								
							echo '  value="true" /></label> ';	 	
						//}
				 echo '</td>';
					
				echo '	<td width="20%" class="tab_riadok" align="right">
							<input type="image" src="'.$acp_cesta.'images/update_button.gif" name="action" value="upravit" style="font-family: verdana, tahoma, arial; font-size: 10px">
							<input type="image" src="'.$acp_cesta.'images/delete_button.gif" name="action" value="delete" style="font-family: verdana, tahoma, arial; font-size: 10px" onclick="javascript:return confirm("Naozaj chces ho zmazat ?")">
						</td>
						
					<tr id="'.$row['id'].'" style="display: none;">	
						<td colspan="4">
						<table>
								<td  align="left" >
									<table width="220" border="0" >
									  <tr>
									    <td  width="50" align="right">Heslo :</td><td  width="140"><input size="50" type="text" name="password" value="';
										//if( if_get_user_access(SUPER_ADMIN)) {
											echo $row['password'];
										//} else {
											//echo "****";
										//}
									 echo '" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td></tr>
									  <tr>
									    <td align="right" >Access : </td>
									    <td >
											<input type="hidden" name="access2" value="'.$row['access'].'">
											<input size="50" type="text" name="access" value="'.$row['access'].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px">
										</td>
									  </tr>
									  <tr>
									    <td  align="right" >Flags : </td>
									    <td  ><input size="50" type="text" name="flags" value="'.$row['flags'].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
									  </tr>
									  <tr>
									    <td  align="right" >Kontakt :</td>
									    <td  ><input size="50" type="text" name="steamid" value="'.$row['steamid'].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
									  </tr>
									  <tr>
									    <td  align="right" >Ine : </td>
									    <td  ><input size="50" type="text" name="nickname" value="'.$row['nickname'].'" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
									  </tr>
									</table>  
								</td>  
								
								<td align="left">
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right">Imunita :</td>
									    <td  width="10" align="center"><input type="checkbox" name="a" value="true" '; if(if_get_user_access(ADMIN_IMMUNITY,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Reserve : </td>
									    <td  align="center"><input type="checkbox" name="b" value="true" '; if(if_get_user_access(ADMIN_RESERVATION,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Kick : </td>
									    <td  align="center"><input type="checkbox" name="c" value="true" '; if(if_get_user_access(ADMIN_KICK,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Slay / slap :</td>
									    <td  align="center"><input type="checkbox" name="e" value="true" '; if(if_get_user_access(ADMIN_SLAY,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Ban : </td>
									    <td  align="center"><input type="checkbox" name="d" value="true" '; if(if_get_user_access(ADMIN_BAN,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  
									</table>
								</td> 
							
								<td align="left">
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right">Mapa :</td>
									    <td  width="10" align="center"><input type="checkbox" name="f" value="true" '; if(if_get_user_access(ADMIN_MAP,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Hlasovanie : </td>
									    <td  align="center"><input type="checkbox" name="j" value="true" '; if(if_get_user_access(ADMIN_VOTE,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>								
									  <tr>
									    <td  align="right" >Chat : </td>
									    <td  align="center"><input type="checkbox" name="i" value="true" '; if(if_get_user_access(ADMIN_CHAT,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Cvar : </td>
									    <td  align="center"><input type="checkbox" name="g" value="true" '; if(if_get_user_access(ADMIN_CVAR,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Cfg :</td>
									    <td  align="center"><input type="checkbox" name="h" value="true" '; if(if_get_user_access(ADMIN_CFG,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>	
									</table>								
								</td> 	 						

								<td align="left">
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right">/admin :</td>
									    <td  width="10" align="center"><input type="checkbox" name="s" value="true" '; if(if_get_user_access(ADMIN_SEE,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" >Menu : </td>
									    <td  align="center"><input type="checkbox" name="u" value="true" '; if(if_get_user_access(ADMIN_MENU,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>								
									</table>								
								</td> 	  
								
								<td align="left">							
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right"><strong>Admin :</strong></td>
									    <td  width="10" align="center"><input type="checkbox" name="n" value="true" '; if(if_get_user_access(ADMIN,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" ><strong>Cheathunter:</strong></td>
									    <td  align="center"><input type="checkbox" name="o" value="true" '; if(if_get_user_access(CHEATHUNTER,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>								
									  <tr>
									    <td  align="right" ><strong>Reklamator:</strong></td>
									    <td  align="center"><input type="checkbox" name="p" value="true" '; if(if_get_user_access(REKLAMATOR,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" ><strong>VIP :</strong></td>
									    <td  align="center"><input type="checkbox" name="r" value="true" '; if(if_get_user_access(VIP,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>
									  <tr>
									    <td  align="right" ><strong>Normal :</strong></td>
									    <td  align="center"><input type="checkbox" name="z" value="true" '; if(if_get_user_access(NORMAL,$row['access'])) { echo "checked"; } echo '></td>
									  </tr>								  
									</table>
								</td>  
								
						</td>
					</table>			
				</tr>
			</tr>		
		</form>	';	 
	}	
} // konec cyklu

	$poradie++;
		// echo
			echo'<form name="admin" method="post" action="'.adresa().'">';
			echo	"<tr bgcolor=\"#f8bf7a\" >";

			echo "		
						<td width=\"8%\" onclick=\"zoznam('0');\" class=\"tab_riadok\" align=\"center\">".$poradie.".</td>
						<td width=\"22%\" onclick=\"zoznam('0');\" class=\"tab_riadok\" align=\"center\">
							<input size=\"50\" type=\"text\" name=\"username\" value=\"\" style=\"font-family: verdana, tahoma, arial; font-size: 10px; width: 140px\"></td>	
						<td width=\"50%\" onclick=\"zoznam('0');\" class=\"tab_riadok\" align=\"center\">";
						for($b=0; $b < count($acp_servers); $b++) {//pre servery
						
							if($_POST['server-'.$b.''] == true) {
						
						
							}
						
						
						
						
							echo ' <label> '.$acp_servers[$b][3].'<input type="checkbox" name="server-'.$b.'"  ';
								while($serverid=mysql_fetch_assoc($lol)) { //cyklus pre mysql
									if($serverid['admin_id']  == $row['id'] ) { // ide o toho admina						
										if($serverid['server_id'] == $acp_servers[$b][1] ) {//ide o ten server
											echo 'checked';
										}		
									}
								}	
							echo '  value="true" /></label> ';		
						}
				 echo '</td>';
				
				echo '<td width="20%" class="tab_riadok" align="right">
						<input type="image" src="'.$acp_cesta.'images/add_button.gif" name="action" value="add" style="font-family: verdana, tahoma, arial; font-size: 10px">
					</td>
					<tr id="0" style="display: none;">	
						<td colspan="4">
						<table>
								<td  align="left" >
									<table width="220" border="0" >
									  <tr>
									    <td  width="50" align="right">Heslo :</td>
									    <td  width="140"><input size="50" type="text" name="password" value="" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
									  </tr>
									  <tr>
									    <td align="right" >Access : </td>
									    <td >
											<input type="hidden" name="access2" value="u">
											<input size="50" type="text" name="access" value="u" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px">
										</td>
									  </tr>
									  <tr>
									    <td  align="right" >Flags : </td>
									    <td  ><input size="50" type="text" name="flags" value="ab" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
									  </tr>
									  <tr>
									    <td  align="right" >Kontakt :</td>
									    <td  ><input size="50" type="text" name="steamid" value="" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
									  </tr>
									  <tr>
									    <td  align="right" >Ine : </td>
									    <td  ><input size="50" type="text" name="nickname" value="" style="font-family: verdana, tahoma, arial; font-size: 10px; width: 140px"></td>
									  </tr>
									</table>  
								</td>  
								
								<td align="left">
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right">Imunita :</td>
									    <td  width="10" align="center"><input type="checkbox" name="a" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Reserve : </td>
									    <td  align="center"><input type="checkbox" name="b" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Kick : </td>
									    <td  align="center"><input type="checkbox" name="c" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Slay / slap :</td>
									    <td  align="center"><input type="checkbox" name="e" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Ban : </td>
									    <td  align="center"><input type="checkbox" name="d" value="true" ></td>
									  </tr>
									  
									</table>
								</td> 
								
								<td align="left">
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right">Mapa :</td>
									    <td  width="10" align="center"><input type="checkbox" name="f" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Hlasovanie : </td>
									    <td  align="center"><input type="checkbox" name="j" value="true" ></td>
									  </tr>								
									  <tr>
									    <td  align="right" >Chat : </td>
									    <td  align="center"><input type="checkbox" name="i" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Cvar : </td>
									    <td  align="center"><input type="checkbox" name="g" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Cfg :</td>
									    <td  align="center"><input type="checkbox" name="h" value="true" ></td>
									  </tr>	
									</table>								
								</td> 	 						

								<td align="left">
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right">/admin :</td>
									    <td  width="10" align="center"><input type="checkbox" name="s" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" >Menu : </td>
									    <td  align="center"><input type="checkbox" name="u" value="true" checked></td>
									  </tr>								
									</table>								
								</td> 	  
								
								<td align="left">							
									<table width="100" border="0" >
									  <tr>
									    <td  width="90" align="right"><strong>Admin :</strong></td>
									    <td  width="10" align="center"><input type="checkbox" name="n" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" ><strong>Cheathunter:</strong></td>
									    <td  align="center"><input type="checkbox" name="o" value="true" ></td>
									  </tr>								
									  <tr>
									    <td  align="right" ><strong>Reklamator:</strong></td>
									    <td  align="center"><input type="checkbox" name="p" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" ><strong>VIP :</strong></td>
									    <td  align="center"><input type="checkbox" name="r" value="true" ></td>
									  </tr>
									  <tr>
									    <td  align="right" ><strong>Normal :</strong></td>
									    <td  align="center"><input type="checkbox" name="z" value="true" ></td>
									  </tr>								  
									</table>
								</td>  
								
						</td>
					</table>			
				</tr>
			</tr>		
		</form>	';
	
	
	
	
	
	
	
// konec tabuky	
	echo '</tbody>
	</table>';

?>