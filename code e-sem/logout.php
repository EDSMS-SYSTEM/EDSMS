<?php

session_start();
session_destroy();
session_unset();

echo "<script>";
echo "window.location = \"login.php\"";
echo "</script>";


?>