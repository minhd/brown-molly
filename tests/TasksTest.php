<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test Adding a new task without anything. Should fail
     *
     * @return void
     */
	public function testAddingTaskFail()
    {
    	$this->json('POST', '/api/tasks',
    		[]
		)->seeJsonEquals([
			"The name field is required.",
			"The user id field is required."
		]);
    }

    /**
     * Test Adding Task without user restriction fail
     *
     * @return void
     */
    public function testAddingTaskFailWithoutUser()
    {
    	$this->json('POST', '/api/tasks',
    		['name'=> 'stuff']
		)->seeJsonEquals([
			"The user id field is required."
		]);
    }

    /**
     * Test Adding a new Task with a correct variables
     *
     * @return void
     */
    public function testAddingTaskCorrectWithUser()
    {
    	$this
	    	->json('POST', '/api/tasks', ['name'=>'stuff', 'user_id'=>1])
	    	->seeJson([
	    		'status' => 'PENDING',
	    		'name' => 'stuff',
	    		'user_id' => 1
	    	]);
    }
}
