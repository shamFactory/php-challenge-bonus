<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
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
                'name' => $name,
            ]]);

        $service = new ContactService($dbMock);

        $contact = $service->findByName($name);
        $this->assertEquals($name, $contact->getName());
        $this->assertEquals($mobile, $contact->getMobile());
    }

    /** @test */
    public function it_returns_null_when_contac_is_not_found()
    {
        $name = 'michael';

        $dbMock = $this->createMock(DBConnection::class);

        $dbMock->method('query');

        $dbMock->method('resultSet')
            ->willReturn([]);

        $service = new ContactService($dbMock);

        $contact = $service->findByName($name);
        $this->assertNull($contact);
    }

    /** @test */
    public function validating_mobiles()
    {
        $tests = [
            '987654321' => true,
            '98765432' => false,
            '98765432X' => false,
            '009876543' => false,
            '9876.4321' => false,
        ];

        foreach ($tests as $number => $hasTobe) {
            if ($hasTobe) {
                $this->assertTrue(ContactService::validateNumber($number));
            } else {
                $this->assertFalse(ContactService::validateNumber($number));
            }
        }
    }
}
