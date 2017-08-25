<?php
session_start();
$sn = 'localhost';
$user = 'stduser';
$pw = 'password';
$db = 'messaging';
$dbc = new mysqli($sn, $user, $pw, $db);
$c_user = $_SESSION['c_user'];
$buddy = $_SESSION['buddy'];

$qry = "SELECT * FROM messages WHERE to_user='$c_user' AND from_user='$buddy'";
$result = $dbc->query($qry);
$stack = array();
while($row = mysqli_fetch_array($result)){
$a = $row['msg_id'];
$b = "~";
$c = $row['msg'];
$t = $a . $b . $c;
array_push($stack, $t);
}

$q = "SELECT * FROM messages WHERE to_user='$buddy' AND from_user='$c_user'";
$res = $dbc->query($q);
$stack_a = array();
while($r = mysqli_fetch_array($res)){
$aa = $r['msg_id'];
$bb = "~";
$cc = $r['msg'];
$tt = "*" . $aa . $bb . $cc;
//array_push($stack_a, $tt);
array_push($stack, $tt);
}
echo json_encode($stack);
?>



