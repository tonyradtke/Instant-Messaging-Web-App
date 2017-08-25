<html>
<head>
<title><font color="green" size="5"> Create user </font></title>
</head>
<body style="background-color:powderblue;">

<form action="create_user.php" method="post">
<b>add a user</b>

<p><font color="green" size="4">User name:</font>
<input type="text" name="user_name" size="30" value="" />
</p>

<p><font color="green" size="4">Password:</font>
<input type="text" name="password" size="30" value="" />
</p>
<p>
<input type="submit" name="submit" value="submit" />
</p>
</form>


<?php
$sn = 'localhost';
$user = 'stduser';
$pw = 'password';
$db = 'messaging';
$dbc = new mysqli($sn, $user, $pw, $db);

if(isset($_POST['submit'])){

$u_name = $_POST['user_name'];
$pwd = $_POST['password'];

$check = "SELECT name FROM users WHERE name='$u_name'";

$result = $dbc->query($check);
if($result->num_rows ==0){
//add to db

$qry = "INSERT INTO users (name, password, user_id) VALUES ('$u_name', '$pwd', NULL)";

if($dbc->query($qry)){ echo '<a href="msg_home.php">login page</a>'; } else { echo "error"; }

} else { echo "username taken please go back"; }

$dbc->close();

}
?>
</body>
</html>



