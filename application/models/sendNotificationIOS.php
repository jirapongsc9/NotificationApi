<?php
class SendNotificationIOS extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	public function loadData($data);
	public function openConnect();
	public function settingConnect();
	public function send();
	public function closeConnect();
	public function result();
}