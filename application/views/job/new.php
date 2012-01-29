<!DOCTYPE html>
<html><head>
<title>Flexmailer | Jobs | New Job</title>
<meta charset="UTF-8">
<meta name="description" content="" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-timepicker-addon.js"></script>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="/js/jquery.snippet.min.js"></script>                         <!-- SNIPPET -->
<script type="text/javascript" src="/js/kickstart.js"></script>                                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="/css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />                          <!-- CUSTOM STYLES -->


<script type="text/javascript">
	$(function() {
		$('#scheduletime').datetimepicker({
			hourGrid: 4,
			minuteGrid: 10,
			dateFormat: 'dd-mm-yy'
		});
	})
</script>
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
	 	<li><a href="/jobs">New Jobs</a></li>
	 </ul>
	 </div>
	 <div class="col_9">
	 		<h4>New Job</h3>
	 		<h6>Campaign: <?php echo($campaignname) ?></h6>
	 		<p>Server Time: <?php echo(date('d-m-Y H:i')); ?></p>
	 		<?php
	 		if (Session::get('formerror')) {
	 			echo('<div class="notice error">'.Session::get('formerror').'</div>');
	 		}
	 		?>
	 		<?php echo (Form::open('/job/finish/'.$campaignname, 'POST')) ?>
	 		<div class="col_4">
	 		<?php echo(Form::label('schedule', 'When do you want this job to run?')) ?>
	 		<?php echo(Form::radio('schedule', 'now', true)); ?>Now
	 		<?php echo(Form::radio('schedule', 'later')); ?>Later
	 		</div>
	 		<div class="col_5">
	 		<?php echo(Form::label('schedule', 'If later, enter date and time')); ?>
	 		<?php echo(Form::text('scheduletime', '', array('id' => 'scheduletime'))) ?>
	 		</div>
	 		<div class="col_9">
	 			<?php echo Form::button('Create Job', array('class' => 'small green', 'type' => 'submit')); ?>
	 		</div>
	 		<?php echo (Form::close()); ?>
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