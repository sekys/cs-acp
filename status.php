<?
$ip ="85.237.232.36:27015";
include("class_hlsi.php");
$gspy = new HLSERVER_INFOS();

if ( $gspy->connect($ip,'27015',true,false,false) == false) {			
	if ($gspy->errno != '') { echo 'Error no.' . $gspy->errno . ' : ' . $gspy->errstr; }
	else { echo 'Error : ' . $gspy->error; }
} else {
	$gspy->parse();
}

?>
<script>
function zobrazSkryj(idecko){
el=document.getElementById(idecko).style;
el.display=(el.display == 'block')?'none':'block';
}
</script>

<style>
a {cursor: pointer; cursor: hand;}
.skryvany {display: none}
</style>

<table align="center"><tr><td>

<div style="_margin-left: -3px; width: 470px; height: 16px; background-image: url('http://cs.gecom.sk/themes/Theme/images/zadava.jpg');">
<table onclick="zobrazSkryj('public')" width="470" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px;">
 <tr valign="top">
	<td width="20" align="center"><img src="http://cs.gecom.sk/themes/Theme/images/cs.gif" style="margin-top: 1px;"></td>
  <td width="211"><span style='color:black' style="font-size: 12px;">&nbsp;<b>GeCom::Lekos CS 1.6 Public</b></span></td>

  <td width="30"><span style='color:black'><b>Sloty:</b></span></td>
	<td width="55"><span><span style='color:black'><? echo $gspy->get_info('players','nc') . '/' . $gspy->get_info('maxplayers','nc'); ?></span></td>
  <td width="80"><span style='color:black'><b>IP adresa:</b></span></td>
	<td width="105" align="right"><span><span style='color:black'>cs.gecom.sk:27015&nbsp;</span></td>
 </tr>
</table>
</div>

<div  id="public" class="skryvany">
<div  style="float: left; width: 160px; height: 290px; margin-top: 2px; background-image: url('http://cs.gecom.sk/themes/Theme/images/bgbgbg.jpg');">
<img src="http://image.www.gametracker.com/images/maps/160x120/cs/<? echo $gspy->get_info('map',''); ?>.jpg" alt="hraná mapa" style="width: 160px; height: 120px;">
<table border="0" cellpadding="0" cellspacing="0">
 <tr height="2"></tr>
 <tr valign="top">
  <td width="60">&nbsp;<span style='color:yellow'>Mapa: </span></td>
  <td width="100"><span><? echo $gspy->get_info('map',''); ?></span></td>
 </tr>

 <tr height="2"></tr>
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Timeleft: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[16][1]; ?></span></td>
 </tr> 
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Nextmap: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[12][1]; ?></span></td>
 </tr>
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Kontakt: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[87][1]; ?></span></td>
 </tr>
 <tr height="8"></tr>
 <tr valign="top" align="center">
  <td width="80" align="center"></td>

  <td width="80" align="center"><a href="hlsw://cs.gecom.sk:27015"><img src="http://cs.gecom.sk/themes/Theme/images/hlsw.gif" alt="hlsw" title="Pripojit cez hlsw"></a>&nbsp;&nbsp;<a href="steam://connect/cs.gecom.sk:27015"><img src="http://cs.gecom.sk/images/steam.jpg" alt="steam" title="Pripojit cez steam"></a></td>
 </tr>
</table>
</div>
<div style="float: right; width: 308px; height: 290; margin-top: 2px; margin-left: 2px; _margin-right: -2px; background-image: url('http://cs.gecom.sk/images/zad_stats.jpg'); ">
<table width="308" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px;">
 <tr valign="top">
  <td width="153"><span style='color:yellow'>&nbsp;Meno/Nick</span></td>
  <td width="50" align="center"><span style='color:yellow'>Sk&oacute;re</span></td>
  <? /*<td width="65" align="center"><span style='color:yellow'>Pripojen&yacute;</span></td>

  <td width="40" align="center"><span style='color:red'>Latencia</span></td>*/ ?>
 </tr>
 <tr height="5"></tr>
</table>
<table width="308" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px; height: auto;">

<?
$rank=0;
for ($i = 0;$i < count($gspy->serv_players);$i++) {
	$rank++;

	 echo '<tr valign="top"><td width="20"><span style="color: #797979;">&nbsp;'.$rank.'</span></td>
				  <td width="133" align="left"><span>'.$gspy->serv_players[$i][0].'</span></td>
				  <td width="50" align="center"><span>'.$gspy->serv_players[$i][1].'</span></td>

			</tr>';					
}
/*				  <td width="65" align="center"><span'.$gspy->serv_players[$i][2].'</span></td>
				  <td width="40" align="center">*</td>*/
?>
</table>
</div>
</div></div>


</td></tr></table>













<?
$ip ="85.237.232.36:27016";
$gspy = new HLSERVER_INFOS();
if ( $gspy->connect($ip,'27016',true,false,false) == false) {			
	if ($gspy->errno != '') { echo 'Error no.' . $gspy->errno . ' : ' . $gspy->errstr; }
	else { echo 'Error : ' . $gspy->error; }
} else {
	$gspy->parse();
}
?>
<table align="center"><tr><td>

<div style="_margin-left: -3px; width: 470px; height: 16px;  background-image: url('http://cs.gecom.sk/themes/Theme/images/zadava.jpg');">
<table  onclick="zobrazSkryj('dust2')"width="470" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px;">
 <tr valign="top">
	<td width="20" align="center"><img src="http://cs.gecom.sk/themes/Theme/images/cs.gif" style="margin-top: 1px;"></td>
  <td width="211"><span style='color:black' style="font-size: 12px;">&nbsp;<b>GeCom::Lekos D2 0nly</b></span></td>

  <td width="30"><span style='color:black'><b>Sloty:</b></span></td>
	<td width="55"><span><span style='color:black'><? echo $gspy->get_info('players','nc') . '/' . $gspy->get_info('maxplayers','nc'); ?></span></td>
  <td width="80"><span style='color:black'><b>IP adresa:</b></span></td>
	<td width="105" align="right"><span><span style='color:black'>cs.gecom.sk:27016&nbsp;</span></td>
 </tr>
</table>
</div>
<div  id="dust2" class="skryvany">
<div style="float: left; width: 160px; height: 290px; margin-top: 2px; background-image: url('http://cs.gecom.sk/themes/Theme/images/bgbgbg.jpg');">
<img src="http://image.www.gametracker.com/images/maps/160x120/cs/de_dust2.jpg" alt="hraná mapa" style="width: 160px; height: 120px;">
<table border="0" cellpadding="0" cellspacing="0">
 <tr height="2"></tr>
 <tr valign="top">
  <td width="60">&nbsp;<span style='color:yellow'>Mapa: </span></td>
  <td width="100"><span><? echo $gspy->get_info('map',''); ?></span></td>
 </tr>

 <tr height="2"></tr>
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Timeleft: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[16][1]; ?></span></td>
 </tr> 
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Nextmap: </span></td>
  <td width="100"><span>de_dust2</span></td>
 </tr>
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Kontakt: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[83][1]; ?></span></td>
 </tr>
 <tr height="8"></tr>
 <tr valign="top" align="center">
  <td width="80" align="center"></td>

  <td width="80" align="center"><a href="hlsw://cs.gecom.sk:27016"><img src="http://cs.gecom.sk/themes/Theme/images/hlsw.gif" alt="hlsw" title="Pripojit cez hlsw"></a>&nbsp;&nbsp;<a href="steam://connect/cs.gecom.sk:27016"><img src="http://cs.gecom.sk/images/steam.jpg" alt="steam" title="Pripojit cez steam"></a></td>
 </tr>
</table>
</div>
<div style="float: right; width: 308px; height: 290px; margin-top: 2px; margin-left: 2px; _margin-right: -2px; background-image: url('http://cs.gecom.sk/images/zad_statsd2.jpg'); ">
<table width="308" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px;">
 <tr valign="top">
  <td width="153"><span style='color:yellow'>&nbsp;Meno/Nick</span></td>
  <td width="50" align="center"><span style='color:yellow'>Sk&oacute;re</span></td>

 </tr>
 <tr height="5"></tr>
</table>
<table width="308" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px; height: auto;">
<?
$rank=0;
for ($i = 0;$i < count($gspy->serv_players);$i++) {
	$rank++;

	 echo '<tr valign="top"><td width="20"><span style="color: #797979;">&nbsp;'.$rank.'</span></td>
				  <td width="133" align="left"><span>'.$gspy->serv_players[$i][0].'</span></td>
				  <td width="50" align="center"><span>'.$gspy->serv_players[$i][1].'</span></td>


			</tr>';					
}

?>
</table>
</div>
</div>

</td></tr></table>








<?
$ip ="85.237.232.36:27020";
$gspy = new HLSERVER_INFOS();
if ( $gspy->connect($ip,'27020',true,false,false) == false) {			
	if ($gspy->errno != '') { echo 'Error no.' . $gspy->errno . ' : ' . $gspy->errstr; }
	else { echo 'Error : ' . $gspy->error; }
} else {
	$gspy->parse();
}
?>

<table align="center"><tr><td>

<div style="_margin-left: -3px; width: 470px; height: 16px;  background-image: url('http://cs.gecom.sk/themes/Theme/images/zadava.jpg');">
<table  onclick="zobrazSkryj('zombie')"width="470" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px;">
 <tr valign="top">
	<td width="20" align="center"><img src="http://cs.gecom.sk/themes/Theme/images/cs.gif" style="margin-top: 1px;"></td>
  <td width="211"><span style='color:black' style="font-size: 12px;">&nbsp;<b>GeCom::Lekos ZOmbIe</b></span></td>

  <td width="30"><span style='color:black'><b>Sloty:</b></span></td>
	<td width="55"><span><span style='color:black'><? echo $gspy->get_info('players','?') . '/' . $gspy->get_info('maxplayers','?'); ?></span></td>
  <td width="80"><span style='color:black'><b>IP adresa:</b></span></td>
	<td width="105" align="right"><span><span style='color:black'>cs.gecom.sk:27020&nbsp;</span></td>
 </tr>
</table>
</div>

<div  id="zombie" class="skryvany">
<div style="float: left; width: 160px; height: 290px; margin-top: 2px; background-image: url('http://cs.gecom.sk/themes/Theme/images/bgbgbg.jpg');">
<img src="http://image.www.gametracker.com/images/maps/160x120/cs/<? echo $gspy->get_info('map',''); ?>.jpg" alt="hraná mapa" style="width: 160px; height: 120px;">
<table border="0" cellpadding="0" cellspacing="0">
 <tr height="2"></tr>
  <tr valign="top">
  <td width="60">&nbsp;<span style='color:yellow'>Mapa: </span></td>
  <td width="100"><span><? echo $gspy->get_info('map',''); ?></span></td>
 </tr>
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Timeleft: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[14][1]; ?></span></td>
 </tr> 
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Nextmap: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[17][1]; ?></span></td>
 </tr>
 <tr valign="top">
  <td width="60"><span style='color:yellow'>&nbsp;Kontakt: </span></td>
  <td width="100"><span><? echo $gspy->serv_rules[77][1]; ?></span></td>
 </tr>
 <tr height="8"></tr>
 <tr valign="top" align="center">
  <td width="80" align="center"></td>

  <td width="80" align="center"><a href="hlsw://cs.gecom.sk:27020"><img src="http://cs.gecom.sk/themes/Theme/images/hlsw.gif" alt="hlsw" title="Pripojit cez hlsw"></a>&nbsp;&nbsp;<a href="steam://connect/cs.gecom.sk:27020"><img src="http://cs.gecom.sk/images/steam.jpg" alt="steam" title="Pripojit cez steam"></a></td>
 </tr>
</table>
</div>
<div style="float: right; width: 308px; height: 290px; margin-top: 2px; margin-left: 2px; _margin-right: -2px; background-image: url('http://cs.gecom.sk/images/zad_stats_zm.jpg'); ">
<table width="308" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px;">
 <tr valign="top">
  <td width="153"><span style='color:yellow'>&nbsp;Meno/Nick</span></td>
  <td width="50" align="center"><span style='color:yellow'>Sk&oacute;re</span></td>

 </tr>
 <tr height="5"></tr>
</table>
<table width="308" border="0" cellpadding="0" cellspacing="0" style="margin-top: 1px; height: auto;">
<?
$rank=0;
for ($i = 0;$i < count($gspy->serv_players);$i++) {
	$rank++;

	 echo '<tr valign="top"><td width="20"><span style="color: #797979;">&nbsp;'.$rank.'</span></td>
				  <td width="133" align="left" style="overflow:hidden;"><span>'.$gspy->serv_players[$i][0].'</span></td>
				  <td width="50" align="center"><span>'.$gspy->serv_players[$i][1].'</span></td>


			</tr>';					
}

?>
</table>
</div>
</div>

</td></tr></table><br>
<center><span style='color:yellow'><small><b>[Status]</b></span> Pre zobrazenie podrobn&yacute;ch &scaron;tatistik, kliknite na jednotliv&eacute; panely serverov.</small></span></center>
