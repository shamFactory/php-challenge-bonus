<?php

namespace App;


class Contact
{
	private $mobile;
	private $name;

	function __construct($mobile, $name)
	{
		$this->mobile = $mobile;
		$this->name = $name;
	}

	/**
	 * Get the value of name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @return  self
	 */
	public function setName($name)
	{
		$this->name = $name;

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