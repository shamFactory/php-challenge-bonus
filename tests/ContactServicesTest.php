<?php

namespace Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use App\Mobile;
use App\Services\TwilioService;
use App\Connections\DBConnection;
use App\Services\ContactService;

class ContactServicesTest extends TestCase
{
    /** @test */
    public function it_returns_contact_when_name_was_sent()
    {
        $name = 'michael';
        $mobile = '987654321';

        $dbMock = $this->createMock(DBConnection::class);

        $dbMock->method('query');

        $dbMock->method('resultSet')
            ->willReturn([[
                'mobile' => $mobile,
                'name' => $name
            ]]);

        $service = new ContactService($dbMock);

        $contact = $service->findByName($name);
        $this->assertEquals($name, $contact->getName());
        $this->assertEquals($mobile, $contact->getMobile());
    }
}
