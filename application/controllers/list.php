<?php
Class List_Controller extends Controller {
	public function action_index() {
		if (Auth::check()) {
			$flash = Session::get('status');
			$user = Auth::user();
			return View::make('list.index')->with('status', $flash)->with('user', $user);
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
			return View::make('list.new')
			->with('status', $flash)
			->with('user', $user)
			->with('formerror', $formerror)
			->with('formsuccess', $formsuccess);
		} else {
			return Redirect::to('/');
		}
	}
	public function action_manage() {
		if (Auth::check()) {
			$flash = Session::get('status');
			$formerror = Session::get('formerror');
			$formsuccess = Session::get('formsuccess');
			$user = Auth::user();
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
			return View::make('list.manage')
			->with('status', $flash)
			->with('user', $user)
			->with('formerror', $formerror)
			->with('formsuccess', $formsuccess)
			->with('mylists', $mylists)
			->with('sharedlists', $sharedlists)
			->with('alllists', $alllists);
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
			$listname = Input::get('listname');
			$listupload = Input::file('listupload');
			$listuploadname = Input::file('listupload.name');
			$listuploadext = File::extension($listuploadname);
			if ($listname and strlen($listname)>=5 and strlen($listname)<16 and $listupload) {
				$m = new Mongo();
				$mdb = $m->flexmailer;
				$templist = $mdb->templist;
				$maillist = $mdb->maillist;
				$sessionid = Session::get('laravel_user_id');
				$listcheck = Maillist::where('listname', '=', $listname)->first();
				$tempcheck = $templist->findOne(array("list" => array("name" => $listname)));
				if ($listcheck) {
					return Redirect::to('/list/new')->with('formerror', 'List name already taken. Please choose another.'.print_r($listcheck));
				}
				$check = $templist->findOne(array('_id' => $sessionid));
				if ($check) {
					$templist->remove(array('_id' => $sessionid), array("safe" => true));
				}
				Session::put('uploadid', $sessionid);
				$templist->insert(array("_id" => $sessionid, "list" => array("name" => $listname)), array("safe" => true));
				$type = Input::file('listupload.type');
				if ($type != "text/csv" and $type != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" and type != "application/vnd.ms-excel") {
					return Redirect::to('/list/new')->with('formerror', 'Please upload a valid xls or csv. Error: '.$type);
				}
				File::upload('listupload', $_SERVER['DOCUMENT_ROOT'].'/upload/'.$user->username.'_'.$listuploadname);
				Session::put('uploadlist', $_SERVER['DOCUMENT_ROOT'].'/upload/'.$user->username.'_'.$listuploadname);
				require_once ('PHPExcel/PHPExcel.php');
				$inputFileType = PHPExcel_IOFactory::identify(Session::get('uploadlist'));
				/**  Create a new Reader of the type that has been identified  **/
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				/**  Load $inputFileName to a PHPExcel Object  **/
				try {
					$objPHPExcel = $objReader->load(Session::get('uploadlist'));
				} catch(Exception $e) {
					return Redirect::to('/list/new')->with('formerror', 'Unable to read file, error is '.$e->getMessage());
				}
				//$objReader->setSheetIndex(0);
				$maxCol = $objPHPExcel->getActiveSheet()->getHighestColumn();
				$cols = PHPExcel_Cell::columnIndexFromString($maxCol);
				$rows = $objPHPExcel->getActiveSheet()->getHighestRow();
				if ($cols>5) {
					$cols = 5;
				}
				$fields = array();
				for ($colp=0; $colp<=($cols-1); $colp++) {
					$val = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($colp, 1)->getCalculatedValue();
					$fields[$colp] = strtolower($val);
				}
				if (!in_array('email', $fields) and !in_array('e-mail', $fields) and !in_array('e_mail', $fields)) {
					return Redirect::to('/list/new')->with('formerror', 'No email head. Column containing e-mail addresses should be named email, e_mail, or e-mail.');
				}
				$candidates = array();
				for ($rp=2; $rp<=$rows; $rp++) {
					for ($cp=0; $cp<=($cols-1); $cp++) {
						$val = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($cp, $rp)->getCalculatedValue();
						$field = $fields[$cp];
						$candidates[$rp-2][$field] = $val;
					}
				}
				$count = 0;
				foreach ($candidates as $index => $fieldarray) {
					if(!filter_var($fieldarray['email'], FILTER_VALIDATE_EMAIL) 
						and !filter_var($fieldarray['e-mail'], FILTER_VALIDATE_EMAIL) 
						and !filter_var($fieldarray['e_mail'], FILTER_VALIDATE_EMAIL)) {
						unset($canidate[$index]);
					}
						$count++;
				}
				$maillist->insert(array("_id" => $listname, "userid" => $sessionid, "fields" => $fields, "candidates" => $candidates));
				$newlist = new Maillist;
				$newlist->user_id = $sessionid;
				$newlist->listname = $listname;
				$newlist->candidates = $count;
				$newlist->save();
				$templist->remove(array('_id' => $sessionid), array("safe" => true));
				return View::make('list.create1')
				->with('status', $flash)
				->with('user', $user)
				->with('formerror', $formerror)
				->with('formsuccess', $formsuccess)
				->with('listname', $listname)
				->with('rows', $rows)
				->with('cols', $cols)
				->with('fields', $fields)
				->with('candidates', $candidates)
				->with('count', $count);
			} else {
				return Redirect::to('/list/new')->with('formerror', 'List name should be more than 4 chars and less than 16 chars. Uploaded file should be a valid csv/excel file.');
			}
			
		} else {
			return Redirect::to('/');
		}
	}
}
