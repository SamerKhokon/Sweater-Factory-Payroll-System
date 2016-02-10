<?php
session_start();
unset($_SESSION['mid2']);
$style_id = $_POST['mid'];
echo $_SESSION['mid2'] = $style_id;
?>