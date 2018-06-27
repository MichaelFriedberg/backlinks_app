<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
   //     $this->visit('/')
    //         ->see('Laravel 5');
   
	      $data = array();
            $data['name'] = 'Test Tester';
             $data['email'] = 'test@example.com';
	 \Mail::send('emails.new-registration-admin-notice', $data, function($message) use ($data)
            {
                $message->from('yourbloggerbucks@gmail.com', "New Register");
                $message->subject("New Signup from ".$data['name']);
                $message->to('disla68@yahoo.com');
		$message->cc('hollywoodfl23@gmail.com');
            });



 }
}
