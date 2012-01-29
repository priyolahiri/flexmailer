<!DOCTYPE html>
<html><head>
<title>Flexmailer | New Campaign | Step 1</title>
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
	 	<li><a href="/list/new">New Campaign</a></li>
	 	<li><a href="#">Step 1</a></li>
	 </ul>
	 </div>
	 <div class="col_9">
	 	<h4>Step 1</h3><br/>
	 	<?php echo Form::open('/campaign/create2') ?>
	 	<div class="col_12">
	 		<?php
	 		if ($formerror) {
	 			echo ('<div class="notice error">'.$formerror.'</div>');
	 		}
			if ($formsuccess) {
	 			echo ('<div class="notice success">'.$formsuccess.'</div>');
	 		}
			?>
	 	</div>
	 	<div class="col_5">
	 		<?php
	 			echo Form::label('subject', 'Message Subject');
				echo Form::text('subject', Session::get('subject'));
			?>
	 	</div>
	 	<div class="col_4">
	 		<?php
	 			echo Form::label('sender', 'Sender Address');
				echo Form::text('sender', Session::get('sender'));
			?>
	 	</div>
	 	<div class="col_9">Links (clicks on these would be tracked on the report)</h6></div>
	 	<div class="col_5">
	 		<?php
	 			echo Form::label('link1', 'Link 1');
				echo Form::text('link1', Session::get('link1'));
			?>
	 	</div>
	 	<div class="col_4">
	 		<?php
	 			echo Form::label('link2', 'Link 2');
				echo Form::text('link2', Session::get('link2'));
			?>
	 	</div>
	 	<div class="col_5">
	 		<?php
	 			echo Form::label('link3', 'Link 3');
				echo Form::text('link3', Session::get('link3'));
			?>
	 	</div>
	 	<div class="col_4">
	 		<?php
	 			echo Form::label('link4', 'Link 4');
				echo Form::text('link4', Session::get('link4'));
			?>
	 	</div>
	 	<div class="col_9">
	 		<?php
	 			echo Form::label('listid', 'Choose List for use with campaign');
				$lists = array();
				foreach ($mylists as $mylist) {
						$lists[$mylist->id] = $mylist->listname;
				}
				if ($user->role == 'admin') {
					foreach ($alllists as $alllist) {
						$lists[$allist->id] = $alllist->listname;
					}
				} else {
					foreach ($sharedlists as $sharedlist) {
						$lists[$sharedist->id] = $sharedlist->listname;
					}
				}
				echo Form::select('listid', $lists, '', array('class' => 'chosen'));
				
			?>
	 	</div>
	 	<div class="col_9">
	 		<?php echo Form::button('Next Step', array('class' => 'small green', 'type' => 'submit')); ?>
	 	</div>	
	 	<?php echo Form::close() ?>
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