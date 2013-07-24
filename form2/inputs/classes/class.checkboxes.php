<?php

namespace plainview\form2\inputs;

/**
	@brief		A convenience input containing checkboxes.
	@author		Edward Plainview <edward@plainview.se>
	@copyright	GPL v3
	@version	20130524
**/
class checkboxes
	extends input
{
	use traits\options;
	use traits\value
	{
		traits\options::use_post_value insteadof traits\value;
		traits\options::value insteadof traits\value;
	}

	public $self_closing = false;
	public $tag = 'div';

	/**
		@brief		This input does not have a real label because each checkbox has one.
		@return		string		A string that describes the checkboxes group.
		@since		20130524
	**/
	public function display_label()
	{
		$label = clone( $this->label );
		$label->tag = 'div';
		$label->clear_attribute( 'for' );
		return $label;
	}

	/**
		@brief		Display the checkboxes in between the div tags.
		@return		string		The checkboxes.
		@since		20130524
	**/
	public function display_value()
	{
		return $this->options_to_inputs();
	}

	/**
		@brief		Create a new checkbox option.
		@param		object			$o		Options.
		@return		checkbox		Newly-created checkbox.
		@see		\\plainview\\form2\\inputs\\traits\\options::option()
		@since		20130524
	**/
	public function new_option( $o )
	{
		$input = new checkbox( $o->container, $o->name );
		if ( isset( $o->id ) )
			$input->set_attribute( 'id', $o->id );
		if ( isset( $o->label ) )
			$input->label( $o->label );
		if ( isset( $o->name ) )
			$input->set_attribute( 'name', $o->name );
		else
			$input->set_attribute( 'name', $o->value );
		return $input;
	}

	/**
		@brief		Assign the prefix to each of the checkboxes.
		@param		string		$prefix		Prefix to append to the checkboxes.
		@return		this		Object chaining.
		@since		20130524
	**/
	public function prefix( $prefix )
	{
		$this->prefix = func_get_args();
		foreach( $this->options as $option )
			$option->prefix = $this->prefix;
		return $this;
	}

	/**
		@brief		Tell each checkbox to use the post value.
		@since		20130524
	**/
	public function use_post_value()
	{
		$name = $this->get_name();
		foreach( $this->options as $index => $option )
		{
			// Create a temporary checkbox, which will contain the complete name inherited from the checkboxes.
			$o = new \stdClass;
			$o->container = $this->container;
			$o->name = $name . '_' . $index;
			$cb = $this->new_option( $o );

			// Clear the check
			$cb->check( false );
			// And now set it according to the post
			$cb->use_post_value();
			$option->check( $cb->is_checked() );
		}
	}
}

