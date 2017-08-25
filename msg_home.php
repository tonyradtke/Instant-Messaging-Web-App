<html>
<div class="heads">
<head><font color="green" size="5"> User Login Page </font></head>
</div>
<body style="background-color:powderblue;">

<div class="heads">
<form action="msg_home.php" method="post">
<p><font color="green" size="4">enter username:</font>
<input type="text" name="username" size="30" value="" />
</p>
<p><font color="green" size="4">enter password:</font>
<input type="text" name="u_password" size="30" value="" />
</p>
<p>
<input type="submit" name="submit" value="submit" />
</p>
</form>
</div>
<style>
.heads{
text-align: centered;
position: relative;
width: 600px;
margin-left: auto;
margin-right: auto;
}

</style>

<?php
$sn = 'localhost';
$user = 'stduser';
$pw = 'password';
$db = 'messaging';
$dbc = new mysqli($sn, $user, $pw, $db);
if(isset($_POST['submit'])){
$username = $_POST['username'];
$pass = $_POST['u_password'];
$qry = "SELECT name FROM users WHERE name='$username' AND password='$pass'";
$result = $dbc->query($qry);
if($result->num_rows !=0){
$c_user = $username;
session_start();
$_SESSION['c_user'] = $c_user;
//echo '<a href="msg_index.php">messaging home page</a>';
header('Location: msg_index.php');
exit;
} else { echo "incorrect login, try again";  }
}//submit is set
?>
<div class="heads">
<a href="create_user.php">no account? make one here</a>
</div>
</body>
</html>



