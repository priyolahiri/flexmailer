<?php
Class Job_Controller extends Controller {
	public function action_index() {
		if (Auth::check()) {
			$flash = Session::get('status');
			$user = Auth::user();
			return View::make('job.index')->with('status', $flash)->with('user', $user);
		} else {
			return Redirect::to('/');
		}
	}
	public function action_create($campaignname) {
		if (Auth::check() and $campaignname) {
			$flash = Session::get('status');
			$user = Auth::user();
			return View::make('job.new')->with('status', $flash)->with('user', $user)->with('campaignname', $campaignname);
		} else {
			return Redirect::to('/');
		}
	}
	public function action_finish($campaignname) {
		if (Auth::check() and $campaignname) {
			$flash = Session::get('status');
			$user = Auth::user();
			$timenow = time();
			$schedule = Input::get('schedule');
			$scheduletime = Input::get('scheduletime');
			$timesched = strtotime($scheduletime);
			if($schedule == "later" and $timesched<$timenow) {
				$formerror = "Scheduled time should be greater than current time.";
				return Redirect::to('/job/create/'.$campaignname)
				->with('status', $flash)
				->with('user', $user)
				->with('campaignname', $campaignname)
				->with('formerror', $formerror);
			}
			$m = new Mongo();
			$mdb = $m->flexmailer;
			$lists = $mdb->maillist;
			$campaigns = $mdb->campaign;
			$jobs = $mdb->jobs;
			$thiscamp = $campaigns->findOne(array('_id' => $campaignname));
			$listsql = Maillist::find($thiscamp['listid']);
			$listname = $listsql->listname;
			$candidates = $listsql->candidates;
			$jobinsert = array('_id' => $user->username."_".date('d/m/YY H:i'), 
									'listname' => $listname, 
									'campaignname' => $campaignname,
									'candidates' => $candidates,
									'sent' => 0,
									'schedule' => $schedule,
									'scheduletime' => $scheduletime,
									'status' => 'processing'
								);
			$jobs->insert($jobinsert, array("safe" => true));
			return View::make('job.finish')->with('status', $flash)->with('user', $user)->with('campaignname', $campaignname);
		} else {
			return Redirect::to('/');
		}
	}
}
