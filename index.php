<?
$page=true; 
include("inc/function.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ACP Ziadost</title>

<?
$eror = "Ziadost bude spracovana len po vyplneni vsetkych udajov !";

$typ = $_POST['select'];
$predmet = $_POST['predmet'];
$email = $_POST['email'];
$comment = htmlspecialchars($_POST['comment']);

if($typ and $predmet and $email and $comment) {	
	if(preg_match("/@/", $email) and preg_match("/./", $email)) {	
		$predmet = "[ " . $typ . " ] " . $predmet;	
		$eror = mysql_comment($email, $predmet, $comment);
	} else {
		$eror = "Email je nespravny.";
	}
}
?>

<style type="text/css">
<!--
.predmet {
padding:10px;
}
.formular {
	width: 600px;
	background-image: url(images/a2.gif);
	border: 1px solid;
	font-weight: bold;
	style="height: 320px;"
}
.formular textarea {
	font-style: italic;
}
body {
	margin-top: 150px;
	background-color: #6a7f94;
}

.credits {
	font-size: 12px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}

a {
	color:black;
	text-decoration: none;
}
.komentar {
	width:99.4%;
	height: 200px;
}
-->
</style>


</head>
<body>

<div align="center" >
  <div class="formular" align="center">
 <form action="index.php" method="post">
		<div class="eror"><br>
			<img src="images/attn_config.png" alt="WARNING" title="ACP Ziadost" align="absmiddle">
			<?
				echo $eror;
			?>
		</div>
		<br>
		<label>Typ
		<select name="select">
		  <option value="Admin" selected >Admin</option>
		  <option value="Unban">Unban</option>
		  <option value="Chyba!">Chyba!</option>
		  <option value="V I P"> VIP </option>
		  <option value=" Ine "> Ine </option>
		</select>
		</label>

		<label class="predmet">Predmet
			<input name="predmet" type="text" maxlength="48" value="<? echo $_POST['predmet']; ?>" size="30">
		</label>

		<label>Email
			<input name="email" type="text" value="<? echo $_POST['email']; ?>" size="15">
		</label>
<div align="left">
<textarea name="comment" class="komentar" maxlength="512" ><?
		if($_POST['comment'])  {
			echo $_POST['comment'];
		} else {
echo " Ziadosti na admina bez tichto bodov budu hned zmazane !
  1. Musis vzdy napisat kolko mas rokov.
  2. Ake mas skusenosti s adminovanim ?
  3. Rozoznas cheatera a skillera ?
  4. Poznas AMX a jeho prikazy ?
  5. Ako si predstavujes adminovat ?
  6. Co si zatial spravyl pre server a co planujes.

 Staznosti bez dema budu tiez zmazane!
";
	} ?>
</textarea>
</div>
	<table width="600" border="0" class="credits">
	  <tr>
	    <td style="padding-right: 150px; padding-left: 5px;">&copy; ACP by Seky</td>
	    <td style="padding-right: 200px;" ><input name="submit" type="submit" value="Odosla&#357;"></td>
	    <td ><a href="login.php">Login &raquo;</a></td>
	  </tr>
	</table>
</div>
</form>  
</div>

</body>
</html>