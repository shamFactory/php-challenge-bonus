<?php

namespace App\Services;

use App\Call;
use App\Contact;
use App\Interfaces\CarrierInterface;
use App\Services\ContactService;
use Twilio\Rest\Client;

class TwilioService implements CarrierInterface
{
    protected $contact;
    protected $message;
    protected $httpClient = null;

    // Your Account SID and Auth Token from twilio.com/console
    private $accountSid = '';
    private $authToken = '';
    private $companyMobile = '';

    function __construct($twilioSettings) {
        $this->accountSid = $twilioSettings->getAccountSid();
        $this->authToken = $twilioSettings->getAuthToken();
        $this->companyMobile = $twilioSettings->getCompanyMobile();

        if (empty($this->accountSid)) {
            throw new \Exception('account sid is undefined');
        }

        if (empty($this->authToken)) {
            throw new \Exception('auth token is undefined');
        }

        if (empty($this->companyMobile)) {
            throw new \Exception('company mobile is undefined');
        }
    }

	public function dialContact(Contact $contact) {
        $this->contact = $contact;

        // validating mobile phone
        /*if (!ContactService::validateNumber($contact->getMobile())) {
            throw new \Exception('invalid mobile');
        }*/
    }

	public function makeCall(): Call
    {
        if (strlen($this->message) > 1600) {
            throw new \Exception('Message cant be longer than 1600');
        }

        $url = 'https://api.twilio.com/2010-04-01/Accounts/'.$this->accountSid.'/Messages.json';
        $request = $this->httpClient->post( $url, [
            'body' => [
                'Body' => $this->message,
                'From' => $this->companyMobile,
                // TODO: make this for differents countries
                'To' => '+51'.$this->contact->getMobile(),
            ]
        ]);

        $request->setAuth($this->accountSid, $this->authToken);
        $response = $request->send();
        var_dump($response->getStatusCode());
        var_dump($response->getBody(true));
        /*
        curl -X POST  \
        --data-urlencode "Body=This is the ship that made the Kessel Run in fourteen parsecs?" \
        --data-urlencode "From=+15017122661" \
        --data-urlencode "To=+15558675310" \
        -u $TWILIO_ACCOUNT_SID:$TWILIO_AUTH_TOKEN

        $client = new Client($this->accountSid, $this->authToken, null, null, $this->httpClient);
        $client->messages->create(
            // TODO: make this for differents countries
            '+51'.$this->contact->getMobile(),
            array(
                'from' => $this->companyMobile,
                'body' => $this->message
            )
        );*/

        return new Call($this->contact->getMobile(), $this->message);
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the value of httpClient
     *
     * @return  self
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;

        return $this;
    }
}