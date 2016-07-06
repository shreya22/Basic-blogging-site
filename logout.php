<?php
session_start();
//session_destroy();
unset($_SESSION['USERNAME']);
require("config.php");
header("Location: " . $config_basedir);
?>