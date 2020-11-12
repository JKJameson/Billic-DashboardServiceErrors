<?php
class DashboardServiceErrors {
	public $settings = array(
		'name' => 'Dashboard Service Errors',
		'description' => 'Shows the list of services which need administrative attention due to automation related errors.',
	);
	function dashboard_submodule() {
		global $billic, $db;
		$title = 'Service Errors';
		if ($count>1)
			$title = "$count $title";
		$html = '';
		$services = $db->q('SELECT `id`, `error` FROM `services` WHERE `error` != ? ORDER BY `nextduedate` DESC LIMIT 5', '');
		if (empty($services)) {
			$html.= 'There are no services with errors.';
		} else {
			$html.= '<table class="table table-striped">';
			foreach ($services as $service) {
				$html.= '<tr><td><a href="/Admin/Services/ID/' . $service['id'] . '/Do/Edit/">' . $service['id'] . '</a></td><td>' . strip_tags($service['error'], '<br>') . '</td></tr>';
			}
			$html.= '</table>';
		}
		return array(
			'header' => $title,
			'html' => $html,
		);
	}
}
