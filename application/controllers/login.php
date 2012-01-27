<?php

class Login_Controller extends Controller {
	public function action_index()
	{
		$username = Input::get('username');
		$password = Input::get('password');
		if (!$username || !$password) {
			$msg = "Please enter both username and password.";
		} else {
			
		}
		return View::make('login.index')->with('msg', $msg);
	}
}