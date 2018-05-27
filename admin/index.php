<?php
session_start();
ob_start();
if(!isset($_SESSION['user_id'])|| empty($_SESSION['user_id'])||!isset($_SESSION['ps'])||empty($_SESSION['ps']))
    header("location:login.php");
else
header("location:register_election.php");

$_SESSION['title'] = "Home";
/**
 * @author franco
 * @copyright 2013
 */
include('header.php');
?>

<div id="content" class="">				
		<div class="container">
        </div>
</div>

<?php
include('footer.php');
ob_end_flush();
?>