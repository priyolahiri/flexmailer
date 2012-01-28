<?php

class Dash_Controller extends Controller {
	public function action_index()
	{
		if (Auth::check()) {
			$flash = Session::get('status');
			$user = Auth::user();
			return View::make('dash.index')->with('status', $flash)->with('user', $user);
		} else {
			return Redirect::to('/login');
		}
	}

}