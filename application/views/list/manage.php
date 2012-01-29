<!DOCTYPE html>
<html><head>
<title>Flexmailer | New List</title>
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
	 	<li><a href="/list">Lists</a></li>
	 	<li><a href="/list/manage">Manage</a></li>
	 </ul>
	 </div>
	 <div class="col_9">
	 	<h4>Manage Lists</h3>
	 	
	 			<h6>My Lists</h6>
	 			<?php
	 			if (count($mylists)>0) {
	 				echo('<table><thead><tr><th>Name</th><th>Candidates</th><th>Sharing</th></tr></thead><tbody>');
					foreach($mylists as $mylist) {
						echo('<tr><td>'.$mylist->listname.'</td><td>'.$mylist->candidates.'</td><td><a href="/list/share/'.$mylist->id.'" class="button small green">Settings</a></td></tr>');
					}
					echo('</tbody></table>');
	 			} else {
	 				echo('<p>You have not created any lists.<br/>
	 				<a href="/list/new" class="button small green">Create a List</a>
	 				</p>');
	 			}
	 			if ($user->role!="admin") {
	 				echo('<h6>Lists Shared With Me</h6>');
					if (count($sharedlists)>0) {
						echo('<table><thead><tr><th>Name</th><th>Candidates</th></tr></thead><tbody>');
						foreach($sharedlists as $sharedlist) {
							echo('<tr><td>'.$sharedlist->listname.'</td><td>'.$sharedlist->candidates.'</td></tr>');
						}
						echo('</tbody></table>');
					} else {
						echo('<p>No list has yet been shared with you.</p>');
					}
	 			} else {
	 				echo('<h6>All Lists</h6>');
					if (count($alllists)>0) {
						echo('<table><thead><tr><th>Name</th><th>Candidates</th><th>Sharing</th></tr></thead><tbody>');
						foreach($allists as $alllist) {
							echo('<tr><td>'.$alllist->listname.'</td><td>'.$alllist->candidates.'</td><td><a href="/list/share/'.$alllist->id.'" class="button small green">Settings</a></td></tr>');
						}
						echo('</tbody></table>');
					} else {
						echo('<p>No other lists exist.</p>');
					}
	 			}
	 			?>
	 		
	 </div>
	 
	 <div class="col_3">
	 <h4>Controls</h4>
	 <ul class="menu vertical right">
    	<li><a href="/dash">Dashboard</a></li>
    	<li class="current"><a href="/list">Lists</a>
    		<ul>
        		<li class="current"><a href="/list/new">New List</a></li>
        		<li><a href="/list/manage">Manage Lists</a></li>
       		</ul>
       	</li>
    	<li><a href="/campaign">Campaigns</a>
    		<ul>
        		<li><a href="/campaign/new">New Campaign</a></li>
        		<li><a href="/campaign/manage">Manage Campaigns</a></li>
       		</ul>
        </li>
    	<li><a href="/reports">Reports</a></li>
    	<?php if($user->role == 'admin') { ?>
    	<li><a href="/user">Users</a>
    		<ul>
        		<li class="current"><a href="/user/new">New User</a></li>
        		<li><a href="/user/manage">Manage Users</a></li>
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