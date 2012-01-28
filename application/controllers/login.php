<?php

class Login_Controller extends Controller {
	public function action_index()
	{
		$username = Input::get('username');
		$password = Input::get('password');
		if (!$username || !$password) {
			$msg = "Please enter both username and password.";
			return View::make('login.index')->with('msg', $msg);
		} else {
			if (Auth::attempt($username, $password))
			{
     			return Redirect::to('/dash')->with('status', 'Successfully logged in!');
			} else {
				$msg = "Please enter correct username and password.";
				return View::make('login.index')->with('msg', $msg);
			}
		}
	}
}