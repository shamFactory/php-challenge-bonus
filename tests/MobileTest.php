<?php

namespace Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use App\Mobile;
use App\Services\TwilioService;

class MobileTest extends TestCase
{
	/** @test */
	public function it_returns_null_when_name_empty()
	{
		$provider = new TwilioService();
		$mobile = new Mobile($provider);

		$this->assertNull($mobile->makeCallByName(''));
	}

}
