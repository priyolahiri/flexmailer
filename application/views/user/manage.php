<!DOCTYPE html>
<html><head>
<title>Flexmailer | Manage Users</title>
<meta charset="UTF-8">
<meta name="description" content="" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="/js/jquery.snippet.min.js"></script>                         <!-- SNIPPET -->
<script type="text/javascript" src="/js/kickstart.js"></script>                                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="/css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
</head><body><a id="top-of-page"></a><div id="wrap" class="clearfix">
<!-- ===================================== END HEADER ===================================== -->


	<!-- 
	
		ADD YOU HTML ELEMENTS HERE
		
		Example: 2 Columns
	 -->
	 <div class="col_6">
	 	<h2>Flexmailer</h2>
	 </div>
	 <div class="col_6">
	 		<?php if ($status) { echo ('<div class="notice success">'.$status.'</div>'); } ?>
	 </div>
	 <div class="col_12">
	 <ul class="breadcrumbs alt1">
	 	<li><a href="/">Flexmailer</a></li>
	 	<li><a href="/user">User</a></li>
	 	<li><a href="/user/manage">Manage User</a></li>
	 </ul>
	 </div>
	 <div class="col_9">
	 		<h4>Manage Users</h3>
	 		<p>Below is the list of users. Use the respective buttons to perform actions.</p>
	 		<?php
	 		if ($formerror) {
	 					echo ('<div class="notice error">'.$formerror.'</div><br/>');
	 				}
					if ($formsuccess) {
	 					echo ('<div class="notice success">'.$formsuccess.'</div><br/>');
	 				}
	 		?>
	 		<table cellspacing="0" cellpadding="0">
    			<thead><tr>
        			<th>Username</th>
        			<th>Role</th>
        			<th>Password</th>
        			<th>Account</th>
    			</tr></thead>
    			<tbody>
    				<?php
    				foreach ($existingusers as $userins) {
    					echo ('<tr>');
    					echo ('<td>'.$userins->username.'</td>');
						echo ('<td>'.$userins->role.'</td>');
						echo ('<td><a href="/user/changepass/'.$userins->id.'" class="button small red">Change</a></td>');
						if ($user->username!=$userins->username) {
							echo ('<td><a href="/user/delete/'.$userins->id.'" class="button small red">Delete</a></td>');
						} else {
							echo ('<td>logged in</td>');
						}
						echo ('</tr>');
    				}
    				?>
    			</tbody>
    		</table>
	 </div>
	 
	 <div class="col_3">
	 <h4>Controls</h4>
	 <ul class="menu vertical right">
    	<li><a href="/dash">Dashboard</a></li>
    	<li><a href="/list">Lists</a>
    		<ul>
        		<li><a href="/list/new">New List</a></li>
        		<li><a href="/list/manage">Manage Lists</a></li>
       		</ul>
       	</li>
    	<li><a href="#">Campaigns</a>
    		<ul>
        		<li><a href="/campaign/new">New Campaign</a></li>
        		<li><a href="/campaign/manage">Manage Campaigns</a></li>
       		</ul>
        </li>
    	<li><a href="/reports">Reports</a></li>
    	<?php if($user->role == 'admin') { ?>
    	<li class="current"><a href="/user">Users</a>
    		<ul>
        		<li><a href="/user/new">New User</a></li>
        		<li class="current"><a href="/user/manage">Manage Users</a></li>
       		</ul>
    	</li>
    	<?php } ?>
    	<li><a href="/logout">Logout</a></li>
	 </ul>
	 </div>


<!-- ===================================== START FOOTER ===================================== -->
<div class="clear"></div>
<div id="footer">
&copy; Copyright 2011–2012 All Rights Reserved. This project was built by <a href="http://priyolahiri.co.cc">Priyadarshi Lahiri</a>
<a id="link-top" href="#top-of-page">Top</a>
</div>

</div><!-- END WRAP -->
</body></html>