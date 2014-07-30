<?php
include_once 'sendNotificationInterface.php';
class SendNotificationAndroid extends CI_Model implements sendNotificationInterface {
	private $registrationIDs;
	private $message;
	private $urlApi;
	private $fields;
	private $headers;
	private $result;
	private $googleKey;
	private $badger;
	private $type;
	private $ch;
	
	function __construct() {
		parent::__construct ();
		
		$this->setGoogleKey ( "AIzaSyDgJlBnBeFT55KGWN6L7livHtgOBRgUPP0" );
		$this->urlApi = "https://android.googleapis.com/gcm/send";
	}
	public function setGoogleKey($googleKey) {
		$this->googleKey = $googleKey;
	}
	public function getGoogleKey() {
		return $this->googleKey;
	}
	public function loadData($data) {
		
		foreach ($data['identifier'] as $identifier){
			$this->registrationIDs[] = $identifier['token'];
		}
	
		$this->message = $data['data']['msg'];
		$this->badger =$data['data']['badger_count'];
		$this->type =$data['data']['type'];
		
		
		$this->fields = array (
				'registration_ids' => $this->registrationIDs,
				'data' => array (
						"message" => $this->message,
						"badger" => $this->badger ,
						"type" => $this->type 
				) 
		);
		$this->headers = array (
				'Authorization: key=' . $this->googleKey,
				'Content-Type: application/json' 
		);
	}
	
	public function send() {
		$this->result = curl_exec ( $this->ch );
	}
	public function result() {
		return $this->result;
	}
	public function openConnect() {
		$this->ch = curl_init ();
	}
	public function closeConnect() {
		if (! curl_errno ( $this->ch )) {
			$this->info = curl_getinfo ( $this->ch );
			
			return 'Took ' . $this->info ['total_time'] . ' seconds to send a request to ' . $this->info ['url'];
		}
		
		curl_close ( $this->ch );
	}
	public function settingConnect() {
		// Set the URL, number of POST vars, POST data
		curl_setopt ( $this->ch, CURLOPT_URL, $this->urlApi );
		curl_setopt ( $this->ch, CURLOPT_POST, true );
		curl_setopt ( $this->ch, CURLOPT_HTTPHEADER, $this->headers );
		curl_setopt ( $this->ch, CURLOPT_RETURNTRANSFER, true );
		// curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields));
		
		curl_setopt ( $this->ch, CURLOPT_SSL_VERIFYPEER, false );
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ( $this->ch, CURLOPT_POSTFIELDS, json_encode ( $this->fields ) );
	}
}

?>