<?php

/**
 * @author franco
 * @copyright 2013
 */
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" /> 
	<title><?php $title = isset($_SESSION['title'])?$_SESSION['title']:"eVote"; echo $title; ?></title> 
	
	<link rel="stylesheet" href="admin/css/all.css" type="text/css" media="screen" title="no title" />
	
	<link rel="stylesheet" href="admin/themes_/.html" type="text/css" media="screen" title="no title" id="theme" />
</head> 
 
<body> 

<div id="wrapper" class="">
	
	<div id="header">		
		<div class="container">
			<div class="grid grid_24">
				
				<ul>							
					<li class="nav">						
                       <h2 style="color: #FFF; ">Electronic Voting System</h2>		
					</li>	
					
                    	<li class="nav profile dropdown right">						
						<a href="javascript:;" class="item"><img src="admin/images/layout/nav_profile_image.png" alt="Profile Image" /></a>	
						
						<div class="menu">	
							<h3>Account</h3>
							
							<ul>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div>
					</li>
					
					<li class="bar right"></li>	
		
				</ul>	
			</div> <!-- .grid -->
		</div> <!-- .container -->
	</div> <!-- #header -->
    
    <div id="sub-header" class="toolbar">		
		<div class="container">
			<?php
            $loc_name = isset($_SESSION['loc_name'])?$_SESSION['loc_name']:"Electronic Voting System";
            $title = isset($_SESSION['title'])?$_SESSION['title']:"eVote";
            ?>
			<div class="grid grid_24">
				<h2><?php  echo $loc_name; ?></h2>	
                <a href="index.php" class="tab">Home</a>
                <?php if($title!="Home") {?>	
                <a href="javascript:;" class="tab"><?php  echo $title; ?></a>
                <?php } ?>		
			</div> <!-- .grid -->			
		</div> <!-- .container -->
	</div> <!-- #sub-header -->