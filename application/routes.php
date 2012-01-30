<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Simply tell Laravel the HTTP verbs and URIs it should respond to. It's a
	| piece of cake to create beautiful applications using the elegant RESTful
	| routing available in Laravel.
	|
	| Let's respond to a simple GET request to http://example.com/hello:
	|
	|		'GET /hello' => function()
	|		{
	|			return 'Hello World!';
	|		}
	|
	| You can even respond to more than one URI:
	|
	|		'GET /hello, GET /world' => function()
	|		{
	|			return 'Hello World!';
	|		}
	|
	| It's easy to allow URI wildcards using (:num) or (:any):
	|
	|		'GET /hello/(:any)' => function($name)
	|		{
	|			return "Welcome, $name.";
	|		}
	|
	*/

	//'GET /' => 'home@index',
	//'GET /login, POST /login' => 'login@index',
	//'GET /dash' => 'dash@index'
	'GET /preview/(:any)' => 'preview@index',
	'GET /track/(:any)/(:any)' => function($campaignname, $link) {
		$ip - $_SERVER['REMOTE_ADDR'];
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$trackers = $mdb->tracker;
		$campaigns = $mdb->campaign;
		$thiscamp = $campaigns->findOne(array("_id" => $campaignname));
		if ($thiscamp) {
			$linkout = "link".$link;
			$visit = $thiscamp[$linkout];
			$trackers->insert(array('campaignname' => $campaignname, 'link' => $linkout, 'ip' => $ip));
			return Redirect::to($visit);
		} else {
			echo ('Bad Address.');
		}
	},
	'GET /opentrack/(:any)' => function($campaignname) {
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$opentrackers = $mdb->opentracker;
		$trackers->insert(array('campaignname' => $campaignname, 'ip' => $ip));
		header('Content-Type: image/gif');
		echo base64_decode("R0lGODdhAQABAIAAAPxqbAAAACwAAAAAAQABAAACAkQBADs=");
	},
	'GET /unsub/(:any)/(:any)' => function($listname, $index) {
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$lists = $mdb->maillist;
		if($lists->update(array('_id' => $listname), array('$pull' => array('candidates' => $index)))) {
			echo("You have been successfully unsubscribed.");
		} else {
			echo("Bad Address");
		}
	},
	'GET /report/(:any)' => function($campaignname) {
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$maillists = $mdb->maillist;
		$campaigns = $mdb->campaigns;
		$reports = $mdb->report;
		$trackers = $mdb->tracker;
		$opentrackers = $mdb->tracker;
		$thiscamp = $campaigns->findOne(array('_id' => $campaignname));
		$thisreport = $reports->find(array('campaignname' => $campaignname));
		$thistrack = $reports->find(array('campaignname' => $campaignname));
		$thistrackopen = $reports->find(array('campaignname' => $campaignname));
		$opencount = $thistrackopen->count();
		$linkarray = array();
		for ($k=1; $k=4; $k++) {
			$var = "link".$k;
			if ($thiscamp[$var]!= NULL) {
				array_push($linkarray, array($var => $thiscamp[$var]));
			}
		}
		
		foreach($linkarray as $var => $link) {
			
		} 
		return View::make('report.index')
		->with('campaignname', $campaignname)
		->with('opencount', $opencount)
		->with('linkarray', $linkarray)
		;
	}
);