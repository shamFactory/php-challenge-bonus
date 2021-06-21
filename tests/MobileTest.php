<?php

namespace Tests;

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

    /** @test */
    public function it_returns_message_when_name_is_not_empty()
    {
        $name = 'michael';
        $mobileNumber = '987654321';
        $message = 'message';

        $dbMock = $this->createMock(DBConnection::class);

        $dbMock->method('query');

        $dbMock->method('resultSet')
            ->willReturn([[
                'mobile' => $mobileNumber,
                'name' => $name,
            ]]);

        $provider = new TwilioService();
        $provider->setMessage($message);
        $mobile = new Mobile($provider, $dbMock);

        $call = $mobile->makeCallByName($name);
        $this->assertEquals($mobileNumber, $call->getMobile());
        $this->assertEquals($message, $call->getMessage());
    }



	/** @test */
	public function it_returns_a_exception_wrong_number()
	{
        $this->expectException(\Exception::class);

		$name = 'michael';
        $mobileNumber = '98765432';
        $message = 'message';

        $dbMock = $this->createMock(DBConnection::class);

        $dbMock->method('query');

        $dbMock->method('resultSet')
            ->willReturn([[
                'mobile' => $mobileNumber,
                'name' => $name,
            ]]);

		$provider = new TwilioService();
		$provider->setMessage($message);
		$mobile = new Mobile($provider, $dbMock);

		$call = $mobile->makeCallByName($name);
	}
}
