<?php
    session_start();
    session_destroy();
    setcookie("user", $_SESSION['user'], time()-7600, "/");
    header('Location: '."index.php");
?>

