<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('hidden1', '', time()-3600);
setcookie('key', '', time()-3600);

header("Location: ../Index.php");
exit;

?>