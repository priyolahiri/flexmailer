<?php
Class User_Controller extends Controller {
	public function action_index() {
		if (Auth::check()) {
			$flash = Session::get('status');
			$user = Auth::user();
			return View::make('user.index')->with('status', $flash)->with('user', $user);
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
			return View::make('user.new')->with('status', $flash)->with('user', $user)->with('formerror', $formerror)->with('formsuccess', $formsuccess);
		} else {
			return Redirect::to('/');
		}
	}
	public function action_create() {
		if (Auth::check()) {
			$user = Auth::user();
			$username = Input::get('username');
			$password = Input::get('password');
			$role = Input::get('role');
			if (($username && strlen($username)<=16 && strlen($username)>=4) && ($password && strlen($password)<=16 && strlen($password)>=4) ) {
				$usercheck = User::where('username', '=', $username)->first();
				if ($usercheck) {
					$formerror = "Username is already in use. Choose another.";
					return Redirect::to('/user/new')->with('formerror', $formerror);
				} else {
					$newuser = New User;
					$newuser->username = $username;
					$newuser->password = md5(password);
					$newuser->role = $role;
					$newuser->save();
					$formsuccess = "Congratulations. User '$username' was created.";
					return Redirect::to('/user/new')->with('formsuccess', $formsuccess);
				}
			} else {
				$formerror = "Username and password should both be filled and should be lesser than 16 characters and more than 3 characters.";
				return Redirect::to('/user/new')->with('formerror', $formerror);
			}
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
			$existingusers = User::all();
			return View::make('user.manage')
				->with('status', $flash)->with('user', $user)
				->with('formerror', $formerror)
				->with('formsuccess', $formsuccess)
				->with('existingusers', $existingusers);
		} else {
			return Redirect::to('/');
		}
	}
	public function action_delete($id) {
		if (Auth::check()) {
			$flash = Session::get('status');
			$formerror = Session::get('formerror');
			$formsuccess = Session::get('formsuccess');
			$user = Auth::user();
			if ($id) {
				$deleteuser = User::find($id);
				if ($deleteuser->username == $user->username) {
					return Redirect::to('/user/manage')->with('formerror', "Cannot delete active account.");
				} else {
					$deleteuser->delete();
					return Redirect::to('/user/manage')->with('formsuccess', "User Deleted.");
				}
			} else {
				return Redirect::to('/');
			}
		} else {
			return Redirect::to('/');
		}
	}
	public function action_changepass($id) {
		if (Auth::check()) {
			$flash = Session::get('status');
			$formerror = Session::get('formerror');
			$formsuccess = Session::get('formsuccess');
			$user = Auth::user();
			$existingusers = User::all();
			if (Input::get(password)) {
				$submit = true;
			} else {
				$submit = false;
			}
			if ($id) {
				$newpass = Input::get('password');
				if ($newpass and strlen($newpass)<=16 and strlen($newpass)>=4) {
					$changeuser = User::find($id);
					if ($changeuser) {
						$changeuser->password = md5($newpass);
						$changeuser->save();
						$formsuccess = "Password successfuly changed!";
						$formerror = "";
					} else {
						return Redirect::to('/');
					}
				} else {
					if ($newpass) {
						$formerror = "Password should be 4 characters min and 16 chars max.";
						$formsuccess = "";
					}
				}
				return View::make('user.changepass')
				->with('status', $flash)->with('user', $user)
				->with('formerror', $formerror)
				->with('formsuccess', $formsuccess)
				->with('existingusers', $existingusers)
				->with('id', $id);
			} else {
				return Redirect::to('/');
			}
		} else {
			return Redirect::to('/');
		}
	}
}
