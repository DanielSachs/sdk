<?php

namespace plainview\form2\validation;

/**
	@brief		A validation error.
	@details

	Uses labels to store the error message.

	Changelog
	---------

	- 20130604	__toString() added.

	@version	20130604
**/
class error
{
	use \plainview\form2\inputs\traits\label;

	/**
		@brief		Which input this error belongs to.
		@var		$container
	**/
	public $container;

	public function __construct( $container )
	{
		$this->container = $container;
	}

	public function __toString()
	{
		return $this->get_label();
	}
}

