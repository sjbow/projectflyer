<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class FlyerControllerTest DESCRIPTION
 * @added on the 28/01/2016
 * @author <sbow>
 * @package admin . megatransfert . ws . youpass . com . net . fr
 * @subpackage common.classes controllers
 * @copyright Youpass
 */
class FlyersControllerTest extends TestCase
{
	/**
	 *
	 * @author <sbow>
	 * @added on the 25/02/2016
	 * @test
	 */
	public function it_shows_the_form_to_create_the_flyer()
	{
		$this->visit('flyers/create');
	}
}
