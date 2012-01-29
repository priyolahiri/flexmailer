<?php
Class Campaign_Controller extends Controller {
	public function action_index() {
		if (Auth::check()) {
			$flash = Session::get('status');
			$user = Auth::user();
			return View::make('campaign.index')->with('status', $flash)->with('user', $user);
		} else {
			return Redirect::to('/');
		}
	}
	public function action_new() {
		if (Auth::check()) {
			$flash = Session::get('status');
			$formerror = Session::get('formerror');
			$formsuccess = Session::get('formsuccess');
			$user = Auth::user();
			return View::make('campaign.new')
			->with('status', $flash)
			->with('user', $user)
			->with('formerror', $formerror)
			->with('formsuccess', $formsuccess);
		} else {
			return Redirect::to('/');
		}
	}
	public function action_create1() {
		if (Auth::check()) {
			$flash = Session::get('status');
			$formerror = Session::get('formerror');
			$formsuccess = Session::get('formsuccess');
			$user = Auth::user();
			$campaignname = Input::get('campaignname') ? Input::get('campaignname') : Session::get('campaignname');
			if (!$campaignname or (strlen($campaignname)<=4 and !strlen($campaignname)>16)) {
				return Redirect::to('/campaign/new')->with('formerror', 'Campaign name should be more than 4 chars and less than 16 chars.');
			};
			$m = new Mongo();
			$mdb = $m->flexmailer;
			$tempcampaign = $mdb->tempcampaign;
			$campaign = $mdb->campaign;
			$formback = Session::get('formback');
			if (!$formback) {
				$namecheck1 = $campaign->findOne(array("_id" => $campaignname));
				$namecheck2 = $tempcampaign->findOne(array("_id" => $campaignname));
				if ($namecheck1 or $namecheck2) {
					return Redirect::to('/campaign/new')->with('formerror', 'Campaign name already taken. Choose another.');
				}
				$tempcampaign->insert(array("_id" => $campaignname, "userid" => Session::get('laravel_user_id')), array("safe" => true));
				Session::put('campaignname', $campaignname);
			}
			$mylists = Maillist::where('user_id', '=', Session::get('laravel_user_id'))->get();
			if ($user->role == "admin") {
				$alllists = Maillist::where('user_id', '!=', Session::get('laravel_user_id'))->get();
			} else {
				$sharedquery = Share::where('user_id', '=', Session::get('laravel_user_id'))->get();
				$sharedids = array();
				foreach($sharedquery as $shared) {
					array_push($sharedids, $shared->maillist_id);
				}
				$sharedlists = Maillist::where_in('id', $sharedids)->get();
			}
			return View::make('campaign.create1')
				->with('status', $flash)
				->with('user', $user)
				->with('formerror', $formerror)
				->with('formsuccess', $formsuccess)
				->with('campaignname', $campaignname)
				->with('mylists', $mylists)
				->with('sharedlists', $sharedlists)
				->with('alllists', $alllists);
		} else {
			return Redirect::to('/');	
		}
	}
	public function action_create2() {
		if (!Auth::check()) {
			return Redirect::to('/');
		}
		$flash = Session::get('status');
		$formerror = Session::get('formerror');
		$formsuccess = Session::get('formsuccess');
		$user = Auth::user();
		$campaignname = Session::get('campaignname');
		$subject = Input::get('subject');
		$sender = Input::get('sender');
		$link1 = Input::get('link1') ? Input::get('link1') : NULL;
		$link2 = Input::get('link2') ? Input::get('link2') : NULL;
		$link3 = Input::get('link3') ? Input::get('link3') : NULL;
		$link4 = Input::get('link4') ? Input::get('link4') : NULL;
		$listid = Input::get('listid');
		$error = "";
		$error .= strlen($subject)<5 ? "Subject must be greater than 4 chars <br/>" : "";
		$error .= !filter_var($sender, FILTER_VALIDATE_EMAIL) ? "Sender address should be valid <br/>" : "";
		$error .= (!filter_var($link1, FILTER_VALIDATE_URL) and $link1) ? "Link 1 should be valid <br/>" : "";
		$error .= (!filter_var($link2, FILTER_VALIDATE_URL) and $link2) ? "Link 2 should be valid <br/>" : "";
		$error .= (!filter_var($link1, FILTER_VALIDATE_URL) and $link3) ? "Link 3 should be valid <br/>" : "";
		$error .= (!filter_var($link1, FILTER_VALIDATE_URL) and $link4) ? "Link 4 should be valid <br/>" : "";
		$error .= !$listid ? "A list selection is required" : "";
		if ($error!="") {
			return Redirect::to('/campaign/create1')
			->with('subject', $subject)
			->with('sender', $sender)
			->with('link1', $link1)
			->with('link2', $link2)
			->with('link3', $link3)
			->with('link4', $link4)
			->with('formerror', $error)
			->with('formback', true);
		}
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$tempcampaign = $mdb->tempcampaign;
		$campaign = $mdb->campaign;
		$maillist = $mdb->maillist;
		$tempcampaign->update(array('_id' => $campaignname), array('$set' => array("subject" => $subject, "sender" => $sender, "listid" => $listid, "link1" => $link1, "link2" => $link2, "link3" => $link3, "link4" => $link4)));
		$listquery = Maillist::find($listid);
		$listname = $listquery->listname;
		$sendlist = $maillist->findOne(array('_id' => $listname));
		$fields = array();
		foreach($sendlist['fields'] as $index => $field) {
			array_push($fields, $field);
		} 
		return View::make('campaign.create2')
				->with('status', $flash)
				->with('user', $user)
				->with('formerror', $formerror)
				->with('formsuccess', $formsuccess)
				->with('campaignname', $campaignname)
				->with('subject', $subject)
				->with('sender', $sender)
				->with('listid', $listid)
				->with('link1', $link1)->with('link2', $link2)->with('link3', $link3)->with('link4', $link4)
				->with('fields', $fields)
				;
	}
	public function action_finish() {
		if (!Auth::check()) {
			return Redirect::to('/');
		}
		$flash = Session::get('status');
		$formerror = Session::get('formerror');
		$formsuccess = Session::get('formsuccess');
		$user = Auth::user();
		$campaignname = Session::get('campaignname');
		$message = Input::get('message');
		$htmlhead = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>##subject##</title>
		<style type="text/css">
		/* Based on The MailChimp Reset INLINE: Yes. */  
		/* Client-specific Styles */
		#outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
		body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;} 
		/* Prevent Webkit and Windows Mobile platforms from changing default font sizes.*/ 
		.ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */  
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
		/* Forces Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */ 
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
		/* End reset */

		/* Some sensible defaults for images
		Bring inline: Yes. */
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;} 
		a img {border:none;} 
		.image_fix {display:block;}

		/* Yahoo paragraph fix
		Bring inline: Yes. */
		p {margin: 1em 0;}

		/* Hotmail header color reset
		Bring inline: Yes. */
		h1, h2, h3, h4, h5, h6 {color: black !important;}

		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}

		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
		color: red !important; /* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
		}

		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
		color: purple !important; /* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */
		}

		/* Outlook 07, 10 Padding issue fix
		Bring inline: No.*/
		table td {border-collapse: collapse;}

		/* Styling your links has become much simpler with the new Yahoo.  In fact, it falls in line with the main credo of styling in email and make sure to bring your styles inline.  Your link colors will be uniform across clients when brought inline.
		Bring inline: Yes. */
		a {color: orange;}


		/***************************************************
		****************************************************
		MOBILE TARGETING
		****************************************************
		***************************************************/
		@media only screen and (max-device-width: 480px) {
			/* Part one of controlling phone number linking for mobile. */
			a[href^="tel"], a[href^="sms"] {
						text-decoration: none;
						color: blue; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
						text-decoration: default;
						color: orange !important;
						pointer-events: auto;
						cursor: default;
					}

		}

		/* More Specific Targeting */

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
		/* You guessed it, ipad (tablets, smaller screens, etc) */
			/* repeating for the ipad */
			a[href^="tel"], a[href^="sms"] {
						text-decoration: none;
						color: blue; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}

			.mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
						text-decoration: default;
						color: orange !important;
						pointer-events: auto;
						cursor: default;
					}
		}

		@media only screen and (-webkit-min-device-pixel-ratio: 2) {
		/* Put your iPhone 4g styles in here */ 
		}

		/* Android targeting */
		@media only screen and (-webkit-device-pixel-ratio:.75){
		/* Put CSS for low density (ldpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1){
		/* Put CSS for medium density (mdpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1.5){
		/* Put CSS for high density (hdpi) Android layouts in here */
		}
		/* end Android targeting */

		</style>

		<!-- Targeting Windows Mobile -->
		<!--[if IEMobile 7]>
		<style type="text/css">
	
		</style>
		<![endif]-->   

		<!-- ***********************************************
		****************************************************
		END MOBILE TARGETING
		****************************************************
		************************************************ -->

		<!--[if gte mso 9]>
		<style>
		/* Target Outlook 2007 and 2010 */
		</style>
		<![endif]-->
		</head>
		<body>
		';
		$htmlfoot = '
		</body>
		</html>
		';
		$campaignname = Session::get('campaignname');
		$mailcontent = $htmlhead.Input::get('message').'<img src="http://'.$_SERVER['HTTP_HOST']."/opentrack/".$campaignname.'" width="1" height="1" alt="icon" />'.$htmlfoot;
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$tempcampaign = $mdb->tempcampaign;
		$campaign = $mdb->campaign;
		$thiscamp = $tempcampaign->findOne(array('_id' => $campaignname));
		$subject = $thiscamp['subject'];
		$link1 = $thiscamp['link1'];
		$link2 = $thiscamp['link2'];
		$link3 = $thiscamp['link3'];
		$link4 = $thiscamp['link4'];
		$mailcontent = str_replace('##subject##',	$subject,	$mailcontent);
		$mailcontent = str_replace('##link1##',		'http://'.$_SERVER['HTTP_HOST'].'/track/'.$campaignname.'/1', 		$mailcontent);
		$mailcontent = str_replace('##link2##', 		'http://'.$_SERVER['HTTP_HOST'].'/track/'.$campaignname.'/2', 		$mailcontent);
		$mailcontent = str_replace('##link3##', 		'http://'.$_SERVER['HTTP_HOST'].'/track/'.$campaignname.'/3', 		$mailcontent);
		$mailcontent = str_replace('##link4##', 		'http://'.$_SERVER['HTTP_HOST'].'/track/'.$campaignname.'/4', 		$mailcontent);
		$mailcontent = str_replace('##unsub##', 	$unsub, 	$mailcontent);
		include(__DIR__.'/../libraries/html2text.php');
		$html = $mailcontent;
		$text = html2text($mailcontent);
		unset($thiscamp['_id']);
		$thiscamp['_id'] = $campaignname;
		$thiscamp['html'] = $html;
		$thiscamp['text'] = strip_tags(Input::get('message'));
		$thiscamp['userid'] = Session::get('laravel_user_id');
		$campaign->insert($thiscamp,  array("safe" => true));
		return View::make('campaign.finish')
				->with('status', $flash)
				->with('user', $user)
				->with('formerror', $formerror)
				->with('formsuccess', $formsuccess)
				->with('campaignname', $campaignname)
				;
	}
	public function action_manage() {
		if (!Auth::check()) {
			return Redirect::to('/');
		}
		$flash = Session::get('status');
		$formerror = Session::get('formerror');
		$formsuccess = Session::get('formsuccess');
		$user = Auth::user();
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$campaign = $mdb->campaign;
		$mycampaigns = $campaign->find(array('userid' => Session::get('laravel_user_id')));
		if ($user->role == "admin") {
			$allcampaigns = $campaign->find();
			return View::make('campaign.manage')
				->with('status', $flash)
				->with('user', $user)
				->with('formerror', $formerror)
				->with('formsuccess', $formsuccess)
				->with('mycampaigns', $mycampaigns)
				->with('allcampaigns', $allcampaigns)
				;
		}
	}
}
