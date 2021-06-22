<?php

namespace App\Services;

use App\Call;
use App\Contact;
use App\Interfaces\CarrierInterface;
use App\Services\ContactService;
use Twilio\Rest\Client;

class TwilioSettingsService
{
    // Your Account SID and Auth Token from twilio.com/console
    private $accountSid = '';
    private $authToken = '';
    private $companyMobile = '';

    function __construct($accountSid, $authToken, $companyMobile = null) {
        $this->accountSid = $accountSid ?? '';
        $this->authToken = $authToken ?? '';
        $this->companyMobile = $companyMobile ?? '+15017122661';
    }

    /**
     * Get the value of companyMobile
     */
    public function getCompanyMobile()
    {
        return $this->companyMobile;
    }

    /**
     * Get the value of authToken
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * Get the value of accountSid
     */
    public function getAccountSid()
    {
        return $this->accountSid;
    }
}