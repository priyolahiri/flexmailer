<!DOCTYPE html>
<html><head>
<title>Flexmailer | Jobs</title>
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
	 	<li><a href="/jobs">Jobs</a></li>
	 </ul>
	 </div>
	 <div class="col_9">
	 		<h4>Jobs</h3>
	 		<?php
	 		if ($data) {
	 			echo('<table><thead><tr><th>Particulars</th><th>Sending Details</th><th>Queing</th><th>Actions</th></tr></thead><tbody>');
				foreach ($data as $record) {
					echo('<tr>');
					echo("<td>Job: ".$record['jobname']."<br/>");
					echo("Campaign: ".$record['campaignname']."</td>");
					echo('<td>Total: '.$record['mailcount']." Sent: ".$record['sentcount'].'</td>');
					echo('<td>'.$record['schedule'].'</td>');
					echo('<td>');
					if ($record['schedule']!="n/a" and strtotime($record['schedule'])-time() > 600) {
						echo('<a href="/job/resched/'.$record['jobname'].'" class="button red small">Reschedule</a>');
					} elseif ($record['schedule'] == "n/a" and $record['mailcount']-$record['sentcount']<10) {
						echo('<a href="/job/resend/'.$record['jobname'].'" class="button red small">Resend</a>');
					}
					echo('</td>');
					echo('</tr>');
				}
				echo('</tbody></table>');
	 		} else {
	 			echo('<p>No jobs found</p>');
	 		}
	 		?>
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
    	<li><a href="/campaign">Campaigns</a>
    		<ul>
        		<li><a href="/campaign/new">New Campaign</a></li>
        		<li><a href="/campaign/manage">Manage Campaigns</a></li>
       		</ul>
        </li>
    	<li  class="current"><a href="/job">Jobs</a></li>
    	<?php if($user->role == 'admin') { ?>
    	<li><a href="/user">Users</a>
    		<ul>
        		<li><a href="/user/new">New User</a></li>
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