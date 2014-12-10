<?
echo '<div id="work-nazov" align="center"><strong>ACP Z&aacute;znam udalosti</strong></div>
<div id="work-obsah">
<div  style="width:250px">
<pre>';
$i=0;
while($_SESSION["log"][$i]) {
	echo ' '.$_SESSION["log"][$i].'';
	$i++;
}
echo '</pre>
</div>
<div style="float:right;">
<strong>Hist&oacute;ria</strong>
13.1.2008 Seky [Admin] Uprava admina ***          14:58
</div>
';
?>