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
	
	<link rel="stylesheet" href="css/all.css" type="text/css" media="screen" title="no title" />
	
	<link rel="stylesheet" href="themes_/.html" type="text/css" media="screen" title="no title" id="theme" />
</head> 
 
<body> 

<div id="wrapper" class="">
	
	<div id="header">		
		<div class="container">
			<div class="grid grid_24">
				
				<ul>							
					<li class="nav">						
						<a href="register_election.php" class="item icon"><span>Home</span></a>					
					</li>	
					
					<li class="bar"></li>
					
					<li class="nav dropdown">						
						<a href="javascript:;" class="item">Elections</a>	
						
						<div class="menu">						
							<h3>Operations</h3>
														
							<ul>
								<li><a href="register_election.php">Register Elections</a></li>
								<li><a href="delete_election.php">Delete Elections</a></li>
                                <li><a href="change_election_state.php">Start/End Election</a></li>
								<li><a href="view_poll.php">View Election Poll</a></li>
							</ul>
						</div>				
					</li>
					
					<li class="nav dropdown">						
						<a href="javascript:;" class="item">Categories</a>
						
						<div class="menu">							
							<h3>Posts</h3>
													
							<ul>
								<li><a href="register_category.php">Register Category</a></li>
								<li><a href="delete_category.php">Delete Category</a></li>
                                 <li><a href="view_categories.php">View All Categories</a></li>
							</ul>
						</div>						
					</li>
					
					<li class="nav dropdown">						
						<a href="javascript:;" class="item">Candidates</a>			
						
						<div class="menu">	
							<h3>Operation</h3>
							
							<ul>
								<li><a href="register_candidate.php">Register Candidate</a></li>
								<li><a href="view_candidates.php?delete=yes">Delete Candidate</a></li>
								<li><a href="view_candidates.php">View Registered Candidates</a></li>
							</ul>
							
						</div>			
					</li>					
					
                    <li class="nav dropdown">						
						<a href="javascript:;" class="item">Voters</a>			
						
						<div class="menu">	
							<h3>Operation</h3>
							
							<ul>
								<li><a href="register_voter.php">Register Voter</a></li>
								<li><a href="delete_voter.php">Delete Voter</a></li>
                                <li><a href="delete_votes.php">Delete Voter's Votes</a></li>
								<li><a href="view_voters.php">View Registered Voters</a></li>
							</ul>
							
						</div>			
					</li>
                    
					<li class="nav profile dropdown right">						
						<a href="javascript:;" class="item"><img src="images/layout/nav_profile_image.png" alt="Profile Image" /></a>	
						
						<div class="menu">	
							<h3>Preferences</h3>
							
							<ul>
								<li><a href="change_username.php">Change Username</a></li>
								<li><a href="change_password.php">Change Password</a></li>
							</ul>
							
							<hr />
							
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
			
			<div class="grid grid_24">
				<h2><?php $loc_name = isset($_SESSION['loc_name'])?$_SESSION['loc_name']:"Electronic Voting System"; echo $loc_name; ?></h2>		
                <a href="javascript:;" class="tab"><?php $title = isset($_SESSION['title'])?$_SESSION['title']:"eVote"; echo $title; ?></a>		
			</div> <!-- .grid -->			
		</div> <!-- .container -->
	</div> <!-- #sub-header -->