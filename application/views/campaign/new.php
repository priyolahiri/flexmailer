<!DOCTYPE html>
<html><head>
<title>Flexmailer | New Campaign</title>
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
	 	<li><a href="/campaign">Campaigns</a></li>
	 	<li><a href="/campaign/new">New Campaign</a></li>
	 </ul>
	 </div>
	 <div class="col_9">
	 	<h4>New Campaign</h3><br/>
	 	<div class="col_5">	
	 			<?php
	 				if ($formerror) {
	 					echo ('<div class="notice error">'.$formerror.'</div>');
	 				}
					if ($formsuccess) {
	 					echo ('<div class="notice success">'.$formsuccess.'</div>');
	 				}
	 				echo Form::open('/campaign/create1', 'POST');
					echo Form::label('campaignname', 'Campaign Name');
	 				echo Form::text('campaignname');
					echo ('<br />');
					echo Form::button('Create Campaign', array('class' => 'small green', 'type' => 'submit'));
					echo Form::close();
	 			?>
	 	</div>	
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
    	<li class="current"><a href="/campaign">Campaigns</a>
    		<ul>
        		<li class="current"><a href="/campaign/new">New Campaign</a></li>
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