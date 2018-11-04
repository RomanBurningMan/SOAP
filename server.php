<?php
/**
 * Bank
 */

header("Content-Type: text/xml; charset=utf-8");

ini_set("soap.wsdl_cache_enabled", "0");

class Bank {
	private $authToken = 123456789;

	function transaction($clientData) {
		if ($this->authToken === $clientData->transaction->authtoken) {
			return "Success transaction from card {$clientData->transaction->usercard} to card {$clientData->transaction->storecard}.<br>
				Cost: {$clientData->transaction->cost}";
		} else {
			throw new SoapFault("Fault transaction","Unknown authentication token.");
		}
	}
}

$server = new SoapServer(__DIR__."/stockquote.wsdl");
$server->setClass("Bank");
$server->handle();
 
