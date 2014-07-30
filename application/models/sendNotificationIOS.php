<?php
class SendNotificationIOS extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	
	public function loadData($data);
	public function openConnect();
	public function closeConnect();
	public function settingConnect();
	public function result();
	public function send();
}