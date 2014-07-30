<?php
interface sendNotificationInterface {
	public function loadData($data);
	public function openConnect();
	public function closeConnect();
	public function settingConnect();
	public function result();
	public function send();
}
?>