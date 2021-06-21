<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Services\TwilioService;
use App\Contact;

class TwilioServicesTest extends TestCase
{
	/** @test */
	public function it_make_a_call()
	{
		$mobile = '987654321';
		$name = 'michael';
		$message = 'hola michael';

		$service = new TwilioService();
		$contact = new Contact($mobile, $name);

		$service->setMessage($message);
		$call = $service->dialContact($contact);

		$this->assertEquals($mobile, $call->getMobile());
		$this->assertEquals($message, $call->getMessage());
	}
}
