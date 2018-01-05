<?php
class DashboardServiceErrors {
	public $settings = array(
		'name' => 'Dashboard Service Errors',
		'description' => 'Shows the list of services which need administrative attention due to automation related errors.',
	);
	function dashboard_submodule() {
		global $billic, $db;
		$html = '';
		$services = $db->q('SELECT `id`, `error` FROM `services` WHERE `error` != ? ORDER BY `nextduedate` DESC LIMIT 5', '');
		if (empty($services)) {
			$html.= '<br><div class="alert alert-success" role="alert">There are no services with errors.</div>';
		} else {
			$html.= '<table class="table table-striped">';
			foreach ($services as $service) {
				$html.= '<tr><td><a href="/Admin/Services/ID/' . $service['id'] . '/Do/Edit/">' . $service['id'] . '</a></td><td>' . strip_tags($service['error'], '<br>') . '</td></tr>';
			}
			$html.= '</table>';
		}
		return array(
			'header' => 'Service Errors',
			'html' => $html,
		);
	}
}
