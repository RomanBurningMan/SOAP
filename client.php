<?php
/**
 * Store
 */

ini_set("soap.wsdl_cache_enabled", "0");

$client = new SoapClient(__DIR__."/stockquote.wsdl");

class Request
{
	public $transaction;
}

class Data
{
	public $authtoken;
	public $usercard;
	public $storecard;
	public $cost;
	public $description;
}

$transactionData = new Request();
$transactionData->transaction = new Data();
$transactionData->transaction->authtoken = 123456789;
$transactionData->transaction->usercard = '0000000000000000';
$transactionData->transaction->storecard = '0000000000000000';
$transactionData->transaction->cost = 100;
$transactionData->transaction->description = 'Buy closes on webstore.com';

try {
	echo $client->transaction($transactionData);
} catch (SoapFault $exception) {
	echo "Fault transaction: $exception" . PHP_EOL;
}
