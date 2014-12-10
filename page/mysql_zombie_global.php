<? if(!$page){ header("Location: ".$acp_cesta."login.php"); } ?>
<div id="work-obsah">
<div id="work-nazov"></div>
<?
if(if_get_user_access(SUPER_ADMIN) == false)
{
	echo '<div class="tip">Nemo&#382;e&scaron; vykon&aacute;va&#357; oper&aacute;cie! </div>';
} else {
	//sql
	if($_POST['sql']) {
		$sql=mysql_prikaz("".$_POST['sql']."");
		echo '<div class="tip">Oper&aacute;cia &quot;'.htmlspecialchars($name, ENT_QUOTES).'&quot; vykonan&aacute;!</div>';
	}	
	//body
	if($_POST['body']) {
		$vip = ($_POST['vip'] == true) ? "" : "WHERE vip = '0'";
		$sql=mysql_prikaz("UPDATE `". $mysql_tab_zombie ."` SET `amount` = ".sterilize($_POST['body'])." ".$vip."");
		
		$vip = ($_POST['vip'] == true) ? "- aj VIP &uacute;&#269;ty" : "";	
		echo '<div class="tip">Nastaven&eacute;'.$_POST['body'].'na ka&#382;d&yacute; &uacute;&#269;et '.$vip.'!</div>';
	}	
	//urok
	if($_POST['urok']) {
		$vip = ($_POST['vip'] == true) ? "" : "WHERE vip = '0'";
		$urok = $_POST['urok'] / 100;
		$sql=mysql_prikaz("UPDATE `". $mysql_tab_zombie ."` SET `amount` = amount - ".$urok."  ".$vip."");
	
		$vip = ($_POST['vip'] == true) ? "- aj VIP &uacute;&#269;ty" : "";	
		echo '<div class="tip"> Aplikovan&yacute; '.$_POST['urok'].'% &uacute;rok na ka&#382;d&yacute; &uacute;&#269;et '.$vip.'!</div>';

	}	
	//delete
	if($_POST['delete']) {
		if($_POST['all'] == true) {			
			$vip = ($_POST['vip'] == true) ? "- aj VIP &uacute;&#269;ty" : "";	
			echo '<div class="tip">Datab&aacute;za pre&#269;isten&aacute; '.$vip.'!</div>';
			
			$vip = "";
			$vip .= ($_POST['vip'] == true) ? "" : "WHERE vip = '0'";

		} else {
			$vip = ($_POST['vip'] == true) ? "- aj VIP &uacute;&#269;ty" : "";	
			echo '<div class="tip">Neakt&iacute;vne &uacute;&#269;ty zmazan&eacute; '.$vip.'!</div>';
			
			$vip = "WHERE amount <= 5";
			$vip .= ($_POST['vip'] == true) ? "" : "AND vip = '0'";
		}		
		$sql=mysql_prikaz("DELETE FROM `". $mysql_tab_zombie ."` ".$vip."");
	}
}
?>

<br>
<table width="600" border="0">
  <tr>
	<form action="<? echo adresa(); ?>" method="post">
		<td><div align="right"><strong>SQL Pr&iacute;kaz:</strong></div></td>
		<td><input name="sql" type="text" size="60" value="<? echo $mysql_tab_zombie; ?>"></td>
		<td><input type="image" src="<? echo $acp_cesta; ?>images/send_button.gif" name="Submit" value="Submit"></td>
	</form>	
  </tr>
  <tr>
	<form action="<? echo adresa(); ?>" method="post">
		<td><div align="right"><strong>Hromadn&eacute; body :</strong></div></td>
		<td><input name="body" type="text" size="10" value="0"> - aj VIP <input type="checkbox" name="vip" value="true" /></td>
		<td><input type="image" src="<? echo $acp_cesta; ?>images/send_button.gif" name="Submit" value="Submit"></td>
	</form>	
 </tr>
  <tr>
  	<form action="<? echo adresa(); ?>" method="post">
		<td><div align="right"><strong>Aplikova&#357; &uacute;rok :</strong></div></td>
		<td><input name="urok" type="text" size="5" value="8"> (%)  - aj VIP <input type="checkbox" name="vip" value="true" /></td>
		<td><input type="image" src="<? echo $acp_cesta; ?>images/send_button.gif" name="Submit" value="Submit"></td>
	</form>	
  </tr>
  <tr>
  	<form action="<? echo adresa(); ?>" method="post">
		<td><div align="right"><strong>Zmaza&#357; &uacute;daje :</strong></div></td>
		<td> 
			<label>
		        V&scaron;etke
		        <input name="all" type="radio" value="true" >
			</label>
		    <label>
		            Neakt&iacute;vne
		            <input type="radio" name="all" value="false" checked > 
			</label>
			 - aj VIP <input type="checkbox" name="vip" value="true" />
		</td>
		<td><input type="image" src="<? echo $acp_cesta; ?>images/send_button.gif" name="delete" value="delete"></td>
	</form>	
  </tr>
</table>
</form>	
