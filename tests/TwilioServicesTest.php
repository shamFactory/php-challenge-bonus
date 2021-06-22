<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Services\TwilioService;
use App\Services\TwilioSettingsService;
use App\Contact;
use Guzzle\Tests\GuzzleTestCase,
    Guzzle\Plugin\Mock\MockPlugin,
    Guzzle\Http\Message\Response,
    Guzzle\Http\Client as HttpClient,
    Guzzle\Service\Client as ServiceClient,
    Guzzle\Http\EntityBody;

class TwilioServicesTest extends TestCase
{
	protected $client;

	/** @test */
	public function it_make_a_call()
	{
		$mobile = '993769490';
		$name = 'michael';
		$message = 'hola michael';
/*
		$mockResponse = new Response(200);
		$mockResponseBody = EntityBody::factory(fopen(
			__DIR__.'/mocks/bodies/twilio-response.json', 'r+')
		);
		$mockResponse->setBody($mockResponseBody);
		$mockResponse->setHeaders(array(
			"Host" => "httpbin.org",
			"User-Agent" => "curl/7.19.7 (universal-apple-darwin10.0) libcurl/7.19.7 OpenSSL/0.9.8l zlib/1.2.3",
			"Accept" => "application/json",
			"Content-Type" => "application/json"
		));

		$plugin = new MockPlugin();
		$plugin->addResponse($mockResponse);
		$client = new HttpClient();
		$client->addSubscriber($plugin);

		$request = $client->get(
			'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID/Messages.json'
		);
		$response = $request->send();

		var_dump($response->getBody(true));*/

		$client = new HttpClient();

		$settings = new TwilioSettingsService('ACf70aa7be14981aeae702960cc7783f90', '2cb47e0c0c1af93d858307527c28a4fd', '+15005550006');
		$service = new TwilioService($settings);
		$service->setHttpClient($client);
		$contact = new Contact($mobile, $name);

		$service->setMessage($message);
		$service->dialContact($contact);
		$call = $service->makeCall();

		$this->assertEquals($mobile, $call->getMobile());
		$this->assertEquals($message, $call->getMessage());
	}
}
