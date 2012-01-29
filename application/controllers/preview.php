<?php
Class Preview_Controller extends Controller {
	public function action_index($name) {
		$m = new Mongo();
		$mdb = $m->flexmailer;
		$campaign = $mdb->campaign;
		$thiscamp = $campaign->findOne(array('_id' => $name));
		echo ($thiscamp['html']);
	}
}
