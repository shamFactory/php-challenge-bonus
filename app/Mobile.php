<?php

namespace App;

use App\Interfaces\CarrierInterface;
use App\Interfaces\ConnectionInterface;
use App\Services\ContactService;

class Mobile
{
	protected $connection;
	protected $provider;

	function __construct(CarrierInterface $provider, ConnectionInterface $connection)
	{
		$this->provider = $provider;
		$this->connection = $connection;
	}


	public function makeCallByName($name = '')
	{
		if( empty($name) ) return;

		$contactService = new ContactService($this->connection);
		$contact = $contactService->findByName($name);

		$this->provider->dialContact($contact);

		return $this->provider->makeCall();
	}


}
