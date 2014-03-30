<html>
<?php

session_start();

$regValue = $_GET['regName'];
$regValue = $_COOKIE['regName'];

echo "Your registration is: ".$regValue.".";

?>

<p><a href="set_reg.php">Back to set_reg.php</a>
</html>