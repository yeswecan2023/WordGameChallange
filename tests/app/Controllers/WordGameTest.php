<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use App\Controllers\WordGame;
use Config\Services;

class WordGameTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    protected function setUp(): void
        {
            parent::setUp();
            
            // Start the session before tests run
            $session = Services::session();
            $session->start();

            // Mock session data
            $session->set('available_letters', 'dgeftoikbvxuaa');
            $session->set('score', 0);
            $session->set('used_words', []);
        }


    public function testSubmitValidWord()
    {
        // Mock POST request with word data
        $request = Services::request();
        $request->setGlobal('post', ['word' => 'DOG']);

        $results = $this->withRequest($request)
                        ->controller(WordGame::class)
                        ->execute('submitWord');

        $this->assertEquals(3, session()->get('score')); // "DOG" has 3 letters
        $this->assertContains('DOG', session()->get('used_words'));
    }

    public function testSubmitInvalidWord()
    {
        // Mock POST request with an invalid word
        $request = Services::request();
        $request->setGlobal('post', ['word' => 'XYZ']);

        $results = $this->withRequest($request)
                        ->controller(WordGame::class)
                        ->execute('submitWord');

        $this->assertEquals(0, session()->get('score')); // Score should remain 0
        $this->assertNotContains('XYZ', session()->get('used_words'));
    }
}
