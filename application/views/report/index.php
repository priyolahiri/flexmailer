<!DOCTYPE html>
<html><head>
<title>Flexmailer | Report</title>
<meta charset="UTF-8">
<meta name="description" content="" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="/js/jquery.snippet.min.js"></script>                         <!-- SNIPPET -->
<script type="text/javascript" src="/js/kickstart.js"></script>                                  <!-- KICKSTART -->
<script type="text/javascript" src="/js/raphael.js"></script>
<script type="text/javascript" src="/js/jquery.enumerable.js"></script>
<script type="text/javascript" src="/js/jquery.tufte-graph.js"></script>
<link rel="stylesheet" type="text/css" href="/css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
<script type="text/javascript">
      $(document).ready(function () {
        jQuery('#awesome').tufteBar({
          data: [
            [50, {label: 'Dog'}],
            [60, {label: 'Raccoon'}],
            [55, {label: 'Albatross'}],
            [80, {label: 'Panda'}],
            [33, {label: 'Tiger'}],
            [44, {label: 'Raptor'}]
          ],
          barWidth: 0.5,
          barLabel:  function(index) { return this[0] },
          axisLabel: function(index) { return this[1].label },
          color:     function(index) { return ['#E57536', '#82293B'][index % 2] }
        });
      });
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
	 	<li><a href="/report/<?php echo($campaignname) ?>">Report for <?php echo($campaignname) ?></a></li>
	 </ul>
	 </div>
	 <div class="col_12">
	 		<h4>Report for <?php echo($campaignname) ?></h3>
	 		<div class="col_12" ><div id="awesome" style="height: 300px;"></div></div>
	 		
	 </div>
	 
	 
<!-- ===================================== START FOOTER ===================================== -->
<div class="clear"></div>
<div id="footer">
&copy; Copyright 2011–2012 All Rights Reserved. This project was built by <a href="http://priyolahiri.co.cc">Priyadarshi Lahiri</a>
<a id="link-top" href="#top-of-page">Top</a>
</div>

</div><!-- END WRAP -->
</body></html>