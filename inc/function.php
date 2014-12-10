<?
if(!$page){ header("Location: ".$acp_cesta."login.php?mode=Nepovoleny pristup"); }

	include("config.php"); // iba nastavenia mena ,hesla a pod
	session_start(); //musi byt uplne na zaciatku inak nefunguje
	
	$acp_temp = 0;

	/* ~~~~~~~~~~~~
	===      Jadro    ===  
	~~~~~~~~~~~~~~ */
/*
function eror_log($sprava) 
{ 

	if($sprava) {
		$_SESSION["log"][] .= $sprava . "<br>";
	} else {
		if($GLOBALS['acp_log_pocet'] != 0) {
		$i = count($_SESSION["log"]);
			for($a=0; $a <= $GLOBALS['acp_log_pocet'];$a++)
			{
				$log .= $_SESSION["log"][$i];
				$i--;
			}
			return $log;
		} else {
			return $_SESSION["log"];
		}
	}
}*/
	function log_write($sprava) 
	{
		$subor = $GLOBALS['acp_log'];
		
		if (file_exists($subor)) {
			if( !is_writable($subor) or is_readable($subor) or is_executable($subor) ) {
				die("Aplikuj chmod 222 na subor ".$GLOBALS['acp_log']." v zlozke ACP");
			}
			
			@$spojenie = fopen( $subor , 'a');
			$co .= "L " . date('H:m d/m/Y') ." - ";
			$co .= ($_SESSION['info'][1]) ? $_SESSION['info'][1]." - " : "ACP - ";
			$co .= $_SERVER["REMOTE_ADDR"]." - ";
			$co .= "Menu:" . $GLOBALS['menu'] . "() - " . $sprava;
			$co .= "\n";
			if( fwrite($spojenie , $co ) == false ) {
				fclose($spojenie);
				return false;
			} else {
				fclose($spojenie);
				return true;
			}
			
		// Neexistuje
		} else {
			die("Vytvor subor ".$GLOBALS['acp_log']." v zlozke ACP.");
		}		
	}
	function get_login() 
	{ //na kazdej stranke overi ci prihlaseni a ci heslo a access sedi....	
		if( 
		isset($_SESSION["info"][1]) and
		isset($_SESSION["info"][2]) and
		isset($_SESSION["info"][3])
		) {
			$riadok = mysql_user_get($_SESSION["info"][1]);
			if(
			$_SESSION["info"][2] ==  $riadok["password"]
			and $_SESSION["info"][3] ==  $riadok["access"] 
			and if_get_user_access(NORMAL) == false
			) 
			{
				return true; 
			} else {
				header("Location: ".$GLOBALS['acp_cesta']."login.php?mode=Nespravne udaje");
			}
		} else {
				header("Location: ".$GLOBALS['acp_cesta']."login.php?mode=Nepovoleny pristup");
		}
	}
	function set_login($info) 
	{ 
		@session_register("info");
		@session_register("servers");
			
		$_SESSION["info"] = $info;
			
		global $acp_servers;
		if(!$acp_servers[0]) {
			die("Ziadny server v nasteveniach!");
		} else {
			$_SESSION["servers"] = $acp_servers[0]; 
		}
	} 
	function instalacia() 
	{
		$sql = mysql_query("CREATE TABLE IF NOT EXISTS `" . $GLOBALS['mysql_tab_log'] . "` ( `datum` VARCHAR( 32 ) NOT NULL, `nick` VARCHAR(32) NOT NULL, `ip` varchar(32) NOT NULL, `sprava` VARCHAR(128) NOT NULL )") or die (mysql_error());	
		$sql = mysql_query("CREATE TABLE IF NOT EXISTS `" . $GLOBALS['mysql_tab_comment'] . "` ( `id` int( 12 ) NOT NULL auto_increment, `cas` VARCHAR( 32 ) NOT NULL, `email` VARCHAR( 32 ) NOT NULL, `predmet` VARCHAR(64) NOT NULL, `comment` varchar(512) NOT NULL, `ip` VARCHAR(32) NOT NULL, `ok` int(2) NOT NULL DEFAULT 0, PRIMARY KEY  (`id`)) DEFAULT CHARSET=utf8") or die (mysql_error());	
		$sql =	mysql_query("CREATE TABLE IF NOT EXISTS `" . $GLOBALS['mysql_tab_admins'] . "` (`id` int(12) NOT NULL auto_increment, `username` varchar(32) default NULL, `password` varchar(32) default NULL, `access` varchar(32) default NULL, `flags` varchar(32) default NULL, `steamid` varchar(32) default NULL, `nickname` varchar(32) NOT NULL default '', PRIMARY KEY  (`id`))") or die (mysql_error());		
	}
	function crypter($pass,$access) 
	{

	$heslo = md5 (
	    $pass .
	    $access .
	    $_SERVER['REMOTE_ADDR']
	 );
		return $heslo;
	}
	function adresa() 
	{
		$adresa = $_SERVER["PHP_SELF"];
		if($_GET['menu']) {
			$adresa = $adresa . "?menu=" . $_GET['menu'];
		}	
		if($_GET['page']) {
			$adresa = $adresa . "&page=" . $_GET['page'];
		}
		return $adresa;
	}
	function server($type) 
	{ //cita a oddeluje servery $type je poradie serveru
		// hodnota
		global $acp_servers;
		global $acp_cesta;

		// echo vypis
		if($type === false) {
			$von .= '<form id="servers-form" method="post" action="'.adresa().'">';
			$von .= '<div align="center"><label>Server <select name="servers" onchange="form.submit()" type="submit" >';
			
			for($b=0; $b < count($acp_servers); $b++) {
				if($_SESSION["servers"][0] == $acp_servers[$b][0]) {
						$von .= '<option selected value="'.$b.'">'.$acp_servers[$b][3].'</option>';
				} else {	
						$von .= '<option value="'. $b .'">'.$acp_servers[$b][3].'</option>';
				}
			}

			$von .= '</select>';
			$von .= '<input type="image" name="server" src="'.$acp_cesta.'images/ok.gif" align="top">';
			$von .= '</label></div></form>';
			
			return $von;
		// nastavit hodnotu podla poradia gameserveru	
		} else {
			$_SESSION["servers"] = $acp_servers[$type];
		}
	}
	function if_get_user_access($access,$string = false) 
	{
		if($string) {
			@$hodnota = strpos($string, $access);
			$hodnota = ($hodnota === false) ? false : true;
			return $hodnota;
		} else {
			if(isset($_SESSION["info"][3])) {
					@$hodnota = strpos($_SESSION["info"][3], $access);
					$hodnota = ($hodnota === false) ? false : true;
					return $hodnota;			
			} else {
			   return false;
			} 
		}
	}

	/* ~~~~~~~~~~~~
	===      Mysql      ===  
	~~~~~~~~~~~~~~ */
	
	function mysql_spojenie() 
	{
		@$spojenie = mysql_connect($GLOBALS['mysql_host'], $GLOBALS['mysql_uzivatel'] ,$GLOBALS['mysql_heslo']) or die("Mysql: Zly server/meno/heslo.");
		@$sql_db = mysql_select_db($GLOBALS['mysql_databaza'], $spojenie) or die("Mysql: Zla databaza");
	}	
	function mysql_prikaz($prikaz) 
	{
		if($GLOBALS['acp_temp'] == 0) 
		{
			mysql_spojenie();
		}	
		if( log_write($prikaz) ) {
			@$sql = mysql_query($prikaz);
		}
		
		$GLOBALS['acp_temp']++;
		return $sql;
	}
	function mysql_user_get($nick) 
	{
		$sql = mysql_prikaz("SELECT * FROM `" . $GLOBALS['mysql_tab_admini'] . "` WHERE username = '" . $nick . "' "); 
		$riadok = mysql_fetch_array($sql);	
		if($sql) {
			return $riadok;
		} else {
			return false;
		}
		/* id 	username 	password 	access 	flags 	steamid 	nickname */
	}
	function mysql_user_set($id = false ,$username = false, $password = false, $access = false, $flags  = false, $steamid  = false, $nickname  = false) 
	{
		$id = mysql_sterilize($id);
		$access = mysql_sterilize($access);
		$flags = mysql_sterilize($flags);
		$steamid = mysql_sterilize($steamid);
		$$nickname = mysql_sterilize($nickname);
		
		if($id == true) {
			$username = ($username) ? "'".$username."'"	: "username";
			$password = ($password) ? "'".$password."'"	: "password";
			$access = ($access) ? "'".$access."'"	: "access";
			$flags = ($flags) ? "'".$flags."'"	: "flags";
			$steamid = ($steamid) ? "'".$steamid."'"	: "steamid";
			$nickname = ($nickname) ? "'".$nickname."'"	: "nickname";
		
			mysql_prikaz(
			"UPDATE `". $GLOBALS['mysql_tab_admini'] ."` SET `username` = ".$username.",
			`password` = ".$password.",
			`access` = ".$access.",
			`flags` = ".$flags.",
			`steamid` = ".$steamid.",
			`nickname` = ".$nickname."  WHERE id = '".$id."'");
		} else {
			// vytvor dalsi ucet
			mysql_prikaz("INSERT INTO `" . $GLOBALS['mysql_tab_admini'] . "` 
			(username, password, access, flags, steamid, nickname) values 
			('".$username."','".$password."','".$access."','".$flags."','".$steamid."','".$nickname."')");
			$von .= "C ";
		}
		
		$von .= $id;
		$von .= $GLOBALS['mysql_tab_admini'];
		$von .= $username;
		$von .= $password;
		$von .= $access;
		$von .= $flags;
		$von .= $steamid;
		$von .= $nickname;
		$von .= mysql_error();
		return $von;
		/* 
		UPDATE `phpbanlist`.`amx_amxadmins` SET `username` = '85.237.233.01',
		`password` = 'lekos1',
		`access` = 'tz1',
		`flags` = 'de1',
		`steamid` = '1',
		`nickname` = '1' WHERE `amx_amxadmins`.`id` =29 LIMIT 1 ;
		*/
	} 
	function mysql_sterilize($hodnota,$type = true)
	{
		if($hodnota) {
			$hodnota = htmlentities($hodnota, ENT_QUOTES);
			if(get_magic_quotes_gpc ()) 
			{ 
				$hodnota = stripslashes ($hodnota); 
			}
			if($type) 
			{ 
				if($GLOBALS['temp']['mysql'] == 0) 
				{
					mysql_spojenie();
				}
				$hodnota = mysql_real_escape_string($hodnota); 
			}
			$hodnota = strip_tags($hodnota);
			
		$hodnota = str_replace("
				", "\n", $hodnota);
				
			return $hodnota;
		} else{
			return $hodnota;
		}
	}
	function mysql_comment($email,$predmet,$comment) 
	{
		$predmet = mysql_sterilize($predmet);
		$email = mysql_sterilize($email);
		$comment = mysql_sterilize($comment);	
		$datum = date('d.m.Y');
		$ip = $_SERVER['REMOTE_ADDR'];	
		$sql = mysql_prikaz("INSERT INTO `" . $GLOBALS['mysql_tab_comment'] . "` (cas, email, predmet, comment, ip, ok) values('" . $datum . "','" . $email . "','" . $predmet . "','" . $comment . "','" . $ip . "','0')");
		if($sql == true) 
		{ 
			return "Ziadost bude v najblizsich dnoch spracovana.";; 
		} else {
			return "Eror: Ziadost nebola poslana."; 
		}	
	} 



	/* ~~~~~~~~~~~~
	===      Mapy    ===  
	~~~~~~~~~~~~~~ */
	
	
	/* ~~~~~~~~~~~~
	===        FTP      ===  
	~~~~~~~~~~~~~~ */
	

	function ftp_spojenie() 
	{		
		@$ftp = ftp_connect($GLOBALS['ftp_host']);
		@$login = ftp_login($ftp, $GLOBALS['ftp_uzivatel'], $GLOBALS['ftp_heslo']);		
		$ftp = ($ftp) ? $ftp : false;
		return $ftp;
	}
	function ftp_zlozka($cesta,$stats = true) 
	{
		$cesta = ftp_rawlist( ftp_spojenie() , $cesta);
		//parser
		if($stats) { // statistyky
			foreach ($cesta as $file) {
				if(ereg("([-dl][rwxst-]+).* ([0-9]*) ([a-zA-Z0-9]+).* ([a-zA-Z0-9]+).* ([0-9]*) ([a-zA-Z]+[0-9: ]*[0-9])[ ]+(([0-9]{2}:[0-9]{2})|[0-9]{4}) (.+)", $file, $regs)) {
			        $type = (int) strpos("-dl", $regs[1]{0});
			        $temp['type'] = $type; //  => 0 subor , 1 zlozka
			        $temp['chmod'] = $regs[1]; // -rw-r--r--
			    /*	$temp['number'] = $regs[2];
					$temp['user'] = $regs[3];
					$temp['group'] = $regs[4];
				 	$temp['all'] = $regs;	*/
			        $temp['kb'] = round($regs[5] / 1024 ); // b  => kb 
			        $temp['datum'] = date("d.m",strtotime($regs[6])) . "." . $regs[7]; // Jul 25  2008 => 25.07.2008

				// Nazov parsujeme na MENO a KONCOVKU
					if($type === 0) {   
						$regs[9] = explode(".", $regs[9]);
						$temp['name']['0'] = '';
						for($i=0; $i < count($regs[9]) - 1;$i++) {					
							$temp['name']['0'] .= $regs[9][$i];					
							$temp['name']['0'] .= ($i != count($regs[9]) - 2 ) ? "." : "";
						}
						$i = count($regs[9]) - 1;
				        $temp['name']['1'] = $regs[9][$i];
					} else {
						$temp['name'] = $regs[9];
					}
				}
				$zlozka[] = $temp;
			}
		} else { // len MENO	
			foreach ($cesta as $file) {
				if(ereg("([-dl][rwxst-]+).* ([0-9]*) ([a-zA-Z0-9]+).* ([a-zA-Z0-9]+).* ([0-9]*) ([a-zA-Z]+[0-9: ]*[0-9])[ ]+(([0-9]{2}:[0-9]{2})|[0-9]{4}) (.+)", $file, $regs)) {
						$zlozka[] = $regs[9]; 			
				}
			}
		}
		return $zlozka;
	}
	function ftp_get_obsah($cesta, $riadky = false ,$mode = FTP_BINARY , $pokracovat = 0 ,$limit = 1024)
	{
		$spojenie = ftp_spojenie();
		// Vytvorenie stream tempu
	    $pipes=stream_socket_pair(STREAM_PF_UNIX, STREAM_SOCK_STREAM, STREAM_IPPROTO_IP);
	    if($pipes===false) return false;
	    if(!stream_set_blocking($pipes[1], 0)){
	        fclose($pipes[0]); fclose($pipes[1]);
	        return false;
	    }
	    $fail=false;
		// stahovanie
	    $data='';
	    if($pokracovat == 0){
	        @$ret = ftp_nb_fget($spojenie, $pipes[0], $cesta, $mode);
	    } else {
	        @$ret = ftp_nb_fget($spojenie, $pipes[0], $cesta, $mode, $pokracovat);
	    }
		
	    while($ret==FTP_MOREDATA){
	        while(!$fail && !feof($pipes[1])){
	            $r=fread($pipes[1], $limit);
	            if($r==='') break;
	            if($r===false){ $fail=true; break; }
	            $data .= $r;
	        }
	        $ret=ftp_nb_continue($spojenie);
	    }
		// Parsovanie,zatazi moc nacitavanie
		if($riadky)	{
			$data = explode("\n", $data);
		}
		
	    fclose($pipes[0]); fclose($pipes[1]);
	    if($fail || $ret!=FTP_FINISHED) {
			//log_write("Ftp: Zle zadana cesta k suboru / serveru !");
			return false;
		}

	    return $data;
	}	
	function ftp_edit_obsah($co,$riadky = false) 
	{
		if($_POST['obsah'] == true ) {
			// kontrola hesie a pod
			if(ftp_sterilize($_POST['obsah'],$riadky)) { 
				return "Security mod aktivovany.";
			} else {	
				ftp_set_obsah("./".$_SESSION["servers"][2]."".$co."",$_POST['obsah']);
			}
		}
		$data = ftp_get_obsah("./".$_SESSION["servers"][2]."".$co."",$riadky);
		
		// echo
		$obsah .= '<form action="'.adresa().'" method="post">';
		$obsah .= '<textarea name="obsah" style="width:95%;height:560px;" class="textarea" >';
		
		if($riadky) {		
			for($i=0;$i < count($data); $i++) {		
				$obsah .= $data[$i] . "\n";
			}
		} else {
			$obsah .= $data;
		}	
		
		$obsah .= '
		</textarea>
			<br>
			<br>
				<div align="center"><input type="image" src="'.$GLOBALS['acp_cesta'].'images/send_button.gif" name="Submit" value="Submit"></div>
			<br>
		</form>	';

		return $obsah;
	}
	function ftp_set_obsah($cesta ,$co ,$mode = FTP_BINARY , $limit = 1024)
	{
		$spojenie = ftp_spojenie();
		//temp
		//    tmpfile()     ................   'php://temp'
		@$temp = fopen( 'php://temp' , 'r+');
		if( fwrite($temp , $co ) == false ) {
			fclose($temp);	
			log_write("Ftp: Eror pri TEMP.");
			return false;
		}	
		//refresh
		rewind($temp);
		// upload
	    @$ret = ftp_nb_fput($spojenie, $cesta, $temp, $mode);
		
	    while($ret==FTP_MOREDATA){
	        $ret=ftp_nb_continue($spojenie);
	    }

	    if($ret!=FTP_FINISHED) {
			@fclose($temp);
			//mysql_log("Ftp: Zle zadana cesta k suboru / serveru !");
			return false;
		} else {
			@fclose($temp);
			log_write("Ftp poslane: ".$cesta);
			return true;
		}
	}		
	function ftp_sterilize($data,$riadky = false) 
	{
		if($riadky) {
			for($b=0;$b < count($data);$b++ ) {
				for($i=0 ;$i < count($GLOBALS['ftp_sterilize']) ; $i++) {
					@$cistic = strpos($data[$b], $GLOBALS['ftp_sterilize'][$i]);
					$cistic = ($cistic === false) ? false : true;
					if($cistic) {
						die("Security: ".$GLOBALS['ftp_sterilize'][$i]."na riadku ".$b."\n
						Poslany prikaz obsahuje nepovolene\n
						znaky preto nemoze byt aplikovany.");
						return true;
					}
				}
			}		
		} else {
			for($i=0 ;$i < count($GLOBALS['ftp_sterilize']) ; $i++) {
				@$cistic = strpos($data, $GLOBALS['ftp_sterilize'][$i]);
				$cistic = ($cistic === false) ? false : true;
				if($cistic) {
					die("Security: ".$GLOBALS['ftp_sterilize'][$i]."\n
					Poslany prikaz obsahuje nepovolene\n
					znaky preto nemoze byt aplikovany.");
					return true;
				}
			}
		}
	}	
	function ftp_log_parser($cesta,$filter)
	{
		// data
		$data = ftp_get_obsah("./".$_SESSION["servers"][2]."".$cesta."", true); 
		
		if($data == false) {
			return false;
		} else {
			// filter
			if( $filter == true) {
				for($i=0;$i < count($data); $i++) {
					if( strpos($data[$i], $_POST['filter']) == true ) {
						$temp[] = $data[$i];
					}
				}
				return $temp;
			} else {
				return $data;	
			}	
		}		
	}	

	/* ~~~~~~~~~~~~
	===     SSH   ===  
	~~~~~~~~~~~~~~ */
// OOP







	
/*
/*
/* function mail() {
	..posle mail KOMU ,RE +PREDMET ,komentar admina	
} 


<style type="text/css">
<!--
.txt_comment {color: #009933}
-->
</style>
// rows="'.count($data).'"
echo '<pre style="width:740px;" class="textarea" >';
	for($i=0;$i < count($data); $i++) {
		
			 System explode parsuje string a VZDY prva hodnota 
		je prazdna alebo neobsauje poznamku.Ostatne hodnoty za cislom 0
		obsahuju dalsie poznamky s ; alebo je to je jednu poznamku. 		
		
		if( strpos($data[$i], ";") !== false ) {
			$data[$i] = explode(";",$data[$i]);
			$temp = '';
			for($b=1;$b < count($data[$i]); $b++) {
				$temp .= '<span class="txt_comment">; ' . $data[$i][$b] . '</span>';
			}
			$data[$i] = $temp;
		}
		// Advertisement
		echo $i + 1; 
		echo " | ";
		echo $data[$i] . "\n";
	}
echo '</pre>';


http://www.dynamicdrive.com/dynamicindex16/richtexteditor/
http://www.dynamicdrive.com/dynamicindex16/openwysiwyg/


// server musi vediet zapisovat do adresara $dir
$dir = "/loguj/sem/";

$logfile = $dir . "/" . date("Y-m-d") . ".txt";

$f = @fopen($logfile, "a");
@flock($f, 2);

$s = date("Y-m-d - H:i:s") . " " .  gethostbyaddr($REMOTE_ADDR) . " $REQUEST_URI - $HTTP_USER_AGENT  - " . $_SERVER['HTTP_REFERER'] . "\n";
@fwrite($f,$s);

@flock($f,3);
@fclose($f);




 function upload() { 
...pouzit FTP fukncie
...pridat CHECk ci ulozit na ZALOHU a SV DOWNLOAD}
function vypis() {...vypis zo zlozku} 


//=================
//==     RCON     ====
//=================
//==       SSH      ====

ftp
http://interval.cz/clanky/jednoduchy-ftp-klient-v-php-1/
http://www.net2ftp.com/homepage/download.html?PHPSESSID=u4lJs5obQUz6PYljEg1CIh-ZPdf
http://sk.php.net/manual/en/book.ftp.php
 $replaced = eregi_replace(";", "<td>", $data);
$replaced2 = eregi_replace("\n", "lol", $replaced);
$replaced3 = eregi_replace("\r", "<tr><td>", $replaced2);
print_r($replaced3); 


$handle = fopen("ftp://cstrike:cslege@10.0.1.3/cs_pub", "r");



// podmienlka
$post_data['has_poll'] = ( $post_info['topic_vote'] ) ? true : false;



// Log parser
rows="'.count($data).'"
<style type="text/css">
<!--
.txt_comment {color: #009933}
-->
</style>
// rows="'.count($data).'"
echo '<pre style="width:740px;" class="textarea" >';
	for($i=0;$i < count($data); $i++) {
		
			 System explode parsuje string a VZDY prva hodnota 
		je prazdna alebo neobsauje poznamku.Ostatne hodnoty za cislom 0
		obsahuju dalsie poznamky s ; alebo je to je jednu poznamku. 		
		
		if( strpos($data[$i], ";") !== false ) {
			$data[$i] = explode(";",$data[$i]);
			$temp = '';
			for($b=1;$b < count($data[$i]); $b++) {
				$temp .= '<span class="txt_comment">; ' . $data[$i][$b] . '</span>';
			}
			$data[$i] = $temp;
		}
		// Advertisement
		echo $i + 1; 
		echo " | ";
		echo $data[$i] . "\n";
	}
echo '</pre>';

 */
?>