<?php

namespace Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use App\Mobile;
use App\Services\TwilioService;
use App\Connections\DBConnection;

class MobileTest extends TestCase
{
	/** @test */
	public function it_returns_null_when_name_empty()
	{
		$provider = new TwilioService();
		$connection = new DBConnection();
		$mobile = new Mobile($provider, $connection);

		$this->assertNull($mobile->makeCallByName(''));
	}


	/* test
	public function it_returns_contact_when_name_was_sent()
	{
		$provider = new TwilioService();
		$mobile = new Mobile($provider);

		$this->assertNull($mobile->makeCallByName(''));
	} */
}
