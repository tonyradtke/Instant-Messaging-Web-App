<?php

session_start();
$sn = 'localhost';
$user = 'stduser';
$pw = 'password';
$db = 'messaging';
$dbc = new mysqli($sn, $user, $pw, $db);

$c_user = $_SESSION['c_user'];
$buddy = $_SESSION['buddy'];

$msg = $_GET['name'];

$qry =  "INSERT INTO messages(to_user, from_user, msg, msg_id) VALUES('$buddy', '$c_user', '$msg', NULL)";
$result = $dbc->query($qry);

header('Location: msg.php');
exit;

?>


