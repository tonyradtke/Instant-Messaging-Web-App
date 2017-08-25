<html>
<div class="heads">
<head><font color="green" size="6"> Home page </font> </head>
<body style="background-color:powderblue;">
</div>
<div class="heads">
<p><font color="green" size="5"> start a chat w a friend </font></p>
<form action="msg_index.php" method="post" >
<p><font color="green" size="4">friends username:</font>
<input type="text" name="buddy" size="30" value="" />
</p>
<p>
<input type="submit" name="submit" value="submit" />
</p>
</form>
</div>
<style>
.heads{
width: 600px;
margin-left: auto;
margin-right:auto;
}
</style>
<?php
session_start();
$c_user = $_SESSION['c_user'];
$sn = 'localhost';
$user = 'stduser';
$pw = 'password';
$db = 'messaging';
$dbc = new mysqli($sn, $user, $pw, $db);

if(isset($_POST['submit'])){

$buddy = $_POST['buddy'];
$qry = " SELECT name from users WHERE name='$buddy'";
$result = $dbc->query($qry);
if($result->num_rows !=0){
$_SESSION['c_user'] = $c_user;
$_SESSION['buddy'] = $buddy;
header('Location: msg.php');
exit;

} else { echo "enter a valid username"; }

}//post isset

?>

</body>
</html>
