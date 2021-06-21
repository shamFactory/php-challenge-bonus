<?php

namespace App\Services;

use App\Call;
use App\Contact;
use App\Interfaces\CarrierInterface;
use App\Services\ContactService;

class TwilioService implements CarrierInterface
{
    protected $contact;
    protected $message;

	public function dialContact(Contact $contact) {
        $this->contact = $contact;

        // validating mobile phone
        if (!ContactService::validateNumber($contact->getMobile())) {
            throw new \Exception('invalid mobile');
        }
    }

	public function makeCall(): Call {

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
}