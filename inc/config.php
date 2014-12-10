<?
if(!$page){ header("Location: http://cs.gecom.sk/web2/lol/acp/login.php"); }
//========
// Mysql
//========
$mysql_host = ""; 
$mysql_uzivatel = "";
$mysql_heslo = "";
$mysql_databaza = "phpbanlist";

$mysql_tab_admini = "amx6_amxadmins";
$mysql_tab_adminservers = "amx6_admins_servers";
$mysql_tab_log = "acp_logs";
$mysql_tab_comment = "acp_comment";
$mysql_tab_zombie = "zp_bank";


//========
// Config
//========
$acp_cesta = "http://cs.minet.sk/acp/"; // Instalacia stranky
$acp_log = "acp_log.php"; 
$acp_log_pocet = 5; //Zobrazi poslednych 5 zaznamov v logoch , 0 vsetko
$acp_lock = false; //Zamkne portal

//========
//SERVERY
//========						IP 				 ID          MENO
$acp_servers[] = array ("10.0.1.3:27015", "17", "hlds_l", "Public");
$acp_servers[] = array ("10.0.1.3:27016", "11", "hlds_d2", "D2 Only");
$acp_servers[] = array ("10.0.1.3:27020", "35", "hlds_zombie", "Zombie"); 


//========
// Users
//========
// Admini :
define("SUPER_ADMIN", "l");
define("HEAD_ADMIN", "m");
define("ADMIN", "n");
define("CHEATHUNTER", "o");
define("REKLAMATOR", "p");
define("VIP", "r");
define("NORMAL", "z");
// Prava :
define("ADMIN_IMMUNITY", "a");
define("ADMIN_RESERVATION", "b");
define("ADMIN_KICK", "c");
define("ADMIN_BAN", "d");
define("ADMIN_SLAY", "e");
define("ADMIN_MAP", "f");
define("ADMIN_CVAR", "g");
define("ADMIN_CFG", "h");
define("ADMIN_CHAT", "i");
define("ADMIN_VOTE", "j");
//define("ADMIN_PASSWORD", "k");
define("ADMIN_SEE", "s");
define("ADMIN_MENU", "u");

// Nepouzite
// define("ADMIN_LEVEL_E		65536	//Flag "q", custom
//  define("ADMIN_LEVEL_G		262144	//Flag "s", custom
// define("ADMIN_LEVEL_H		524288	//Flag "t", custom

define("FLAG_KICK", "a"); //kick ,nespravne heslo
define("FLAG_TAG", "b"); // TAB
define("FLAG_AUTHID", "c"); // steam 
define("FLAG_IP", "d"); // ip
define("FLAG_NOPASS", "e"); // netreba heslo

//========
// 
//========

//========
// FTP
//========
$ftp_host = ""; 
$ftp_uzivatel = "";
$ftp_heslo = "";
$ftp_sterilize = array( // Neziadane mena v suboroch
					"rcon_password",
					"sv_password",
					"rcon", 
					"heslo",
					"pass",
					"amx_addadmins",
					"amx_gamename",
					"hostname",
					"sv_password",
					)



?>