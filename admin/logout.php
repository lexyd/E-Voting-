<?php
session_start();
/**
 * @author franco
 * @copyright 2013
 */

session_destroy();
header("location:login.php");
?>