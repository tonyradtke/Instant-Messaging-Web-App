
<?php
$u_name = $_POST['user_name'];
$pwd = $_POST['password'];

$sn = 'localhost';
$user = 'stduser';
$pw = 'password';
$db = 'messaging';
$dbc = new mysqli($sn, $user, $pw, $db);

$qry = "INSERT INTO students(name, password, user_id) VALUES ($u_name, $pwd, NULL)";


 if ($dbc->query($qry) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: ";
        }

$dbc->close();

?>

