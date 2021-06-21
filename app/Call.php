<?php

namespace App;


class Call
{
	protected $mobile;
	protected $message;

	function __construct($mobile, $message)
	{
		$this->mobile = $mobile;
		$this->message = $message;
	}

	/**
	 * Get the value of message
	 */
	public function getMessage()
	{
		return $this->message;
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
	 * Get the value of mobile
	 */
	public function getMobile()
	{
		return $this->mobile;
	}

	/**
	 * Set the value of mobile
	 *
	 * @return  self
	 */
	public function setMobile($mobile)
	{
		$this->mobile = $mobile;

		return $this;
	}
}