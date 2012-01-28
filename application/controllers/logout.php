<?php
Class Logout_Controller extends Controller {
	public function action_index() {
		Auth::logout();
		return Redirect::to('/')->with('status', "Successfully logged out!");
	}
}
