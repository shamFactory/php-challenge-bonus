<?php

namespace App\Services;

use App\Call;
use App\Contact;
use App\Interfaces\CarrierInterface;


class TwilioService implements CarrierInterface
{

	public function dialContact(Contact $contact) {

    }

	public function makeCall(): Call {
        return new Call();
    }
}