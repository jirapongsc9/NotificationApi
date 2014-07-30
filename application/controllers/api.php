<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

class Api extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index() {
		$data ['title'] [] = "test";
		$data ['title'] [] = "test2";
		$this->load->view ( 'testView', $data );
	}
	
	public function sendNotification() {
		
		//$device =  $_POST['data']['device'];
		$this->load->model('SendNotificationAndroid','Notification');
		//$this->load->model('SendNotificationIOS','Notification');

		$this -> load -> library("testLib");
		
		$num = new testLib(24);
		
		echo $num->test();
		
		//e
		
		$this->Notification->loadData($_POST);
		
		$this->Notification->openConnect();
		$this->Notification->settingConnect();
		$this->Notification->send();
		$this->Notification->closeConnect();
		
		echo $this->Notification->result();
		/*
		*/
		//
	}
}
