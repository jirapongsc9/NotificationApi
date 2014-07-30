<?php
interface sendNotificationInterface {
	public function loadData($data);
	public function openConnect();
	public function closeConnect();
	public function init();
	public function result();
	public function send();
}
?>