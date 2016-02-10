<?php
session_start();
unset($_SESSION['usr_id']);
unset($_SESSION['user_role']);
unset($_SESSION['user_name']);
header("Location: index.php");
?>