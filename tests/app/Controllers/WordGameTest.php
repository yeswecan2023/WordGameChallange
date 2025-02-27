<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use App\Controllers\WordGame;
use Config\Services;
use ReflectionClass;

class WordGameTest extends CIUnitTestCase
{
    use ControllerTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Define FCPATH for testing if not already defined
        if (!defined('FCPATH')) {
            define('FCPATH', WRITEPATH);
        }

        // Create a mock words.txt file with valid words
        $this->testWordsFile = WRITEPATH . 'words.txt';
        file_put_contents($this->testWordsFile, "ONE\nTON\nSON\nNOTE\nNOT\nNET\nSET\nTOE\nNO\nON\nTO\nFOX\nIT\n");
    }

    protected function tearDown(): void
    {
        // Remove the test file after tests run
        if (file_exists($this->testWordsFile)) {
            unlink($this->testWordsFile);
        }
    }

    public function testIsValidWordFromFile()
    {
        $wordGame = new WordGame();

        // Use Reflection to access the private method
        $reflection = new ReflectionClass($wordGame);
        $method = $reflection->getMethod('isValidWordFromFile');
        $method->setAccessible(true); // Make the private method accessible

        // Test valid words
        $this->assertTrue($method->invoke($wordGame, 'ONE'));
        $this->assertTrue($method->invoke($wordGame, 'NOTE'));
        $this->assertTrue($method->invoke($wordGame, 'FOX'));
        $this->assertTrue($method->invoke($wordGame, 'IT'));

        // Test invalid words
        $this->assertFalse($method->invoke($wordGame, 'DOG'));  // Not in list
        $this->assertFalse($method->invoke($wordGame, 'APPLE')); // Not in list
        $this->assertFalse($method->invoke($wordGame, 'ELEPHANT')); // Not in list
    }

    public function testCanConstructWord()
    {
        $wordGame = new WordGame();

        // Use Reflection to access the private method
        $reflection = new ReflectionClass($wordGame);
        $method = $reflection->getMethod('canConstructWord');
        $method->setAccessible(true); // Make the private method accessible

        $letters = 'onetfox';

        // Test words that can be formed
        $this->assertTrue($method->invoke($wordGame, 'one', $letters));
        $this->assertTrue($method->invoke($wordGame, 'fox', $letters));
        $this->assertTrue($method->invoke($wordGame, 'ton', $letters));

        // Test words that cannot be formed
        $this->assertFalse($method->invoke($wordGame, 'note', 'ontf')); // Missing 'e'
        $this->assertFalse($method->invoke($wordGame, 'set', 'onex')); // Missing 's' and 't'
        $this->assertFalse($method->invoke($wordGame, 'elephant', $letters)); // Word too long, missing letters
    }

}
