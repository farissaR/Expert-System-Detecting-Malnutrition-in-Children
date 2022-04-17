<?php
if (!isset($_SESSION)) {
session_start();
}
header('Cache-control: private');
// IE 6 FIX
if (isSet($_GET['lang'])) {
	$lang = $_GET['lang'];

	// register the session and set the cookie
	$_SESSION['lang'] = $lang;

	setcookie("lang", $lang, time() + (3600 * 24 * 30));
} else if (isSet($_SESSION['lang'])) {
	$lang = $_SESSION['lang'];
} else if (isSet($_COOKIE['lang'])) {
	$lang = $_COOKIE['lang'];
} else {
	$lang = 'indo';
}

switch ($lang) {
	case 'indo' :
		$lang_file = 'indo.php';
		break;
		case 'eng' :
		$lang_file = 'eng.php';
		break;

	default :
		$lang_file = 'indo.php';
}

include_once 'bahasa/' . $lang_file;
?>
