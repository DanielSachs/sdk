<?php

namespace plainview\form2\tests;

class CheckboxesTest extends TestCase
{
	public function checkboxes()
	{
		return $this->form()->checkboxes( 'checkboxestest' )
			->label( 'Checkboxes' )
			->option( 'Checkbox 1', 'cb1' )
			->option( 'Checkbox 2', 'cb2' )
			->option( 'Checkbox 3', 'cb3' )
			->value( 'cb2' );
	}

	public function test_ids()
	{
		$cbs = $this->checkboxes();
		$this->assertStringContains( 'id="checkboxestest_cb1"', $cbs->display_input() );
		$this->assertStringContains( 'id="checkboxestest_cb2"', $cbs->display_input() );
		$this->assertStringContains( 'id="checkboxestest_cb3"', $cbs->display_input() );
		$this->assertStringDoesNotContain( 'id="checkboxestest"', $cbs->display_input() );
	}

	public function test_names()
	{
		$cbs = $this->checkboxes();
		$this->assertStringContains( 'name="checkboxestest_cb1"', $cbs->display_input() );
		$this->assertStringContains( 'name="checkboxestest_cb2"', $cbs->display_input() );
		$this->assertStringContains( 'name="checkboxestest_cb3"', $cbs->display_input() );
		$this->assertStringDoesNotContain( 'name="checkboxestest"', $cbs->display_input() );
	}

	public function test_checked()
	{
		$cbs = $this->checkboxes();
		$this->assertStringContainsRegexp( '/\.*\<input.*\<input.*checked=\"checked\".*cb3/s', $cbs->display_input() );
	}

	public function test_labels()
	{
		$cbs = $this->checkboxes();
		$this->assertEquals( '<div>Checkboxes</div>', $cbs->display_label() );
		$this->assertStringContains( '<label for="checkboxestest_cb1">Checkbox 1</label>', $cbs->display_input() );
	}
}

