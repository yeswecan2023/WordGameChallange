<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\GameModel;

class WordGame extends Controller
{
    public function index() {
        $gameModel = new GameModel();
        $data['topScores'] = $gameModel->getTopScores();
        return view('game_view', $data);
    }

    public function startGame() {
        $letters = 'dgeftoikbvxuaa';
        $letterCounts = array_count_values(str_split($letters)); // Count letters
        session()->set('available_letters', $letters);
        session()->set('score', 0);
        session()->set('used_words', []);
        session()->set('letterCounts', $letterCounts);
        return view('play_game', ['letters' => $letters]);
    }

    public function submitWord() {
        $word = strtoupper($this->request->getVar('word')); // Convert to uppercase
        $letters = session()->get('available_letters');
        $score = session()->get('score') ?? 0; // Ensure default score is 0
        $usedWords = session()->get('used_words') ?? []; // Ensure it's an array
    
        if (in_array($word, $usedWords)) {
            return redirect()->back()->with('message', 'Word already used!');
        }
    
        // Validate against words.txt
        if (!$this->isValidWordFromFile($word)) {
            return redirect()->back()->with('message', 'Invalid English word!');
        }
    
        if (!$this->canConstructWord(strtolower($word), $letters)) {
            return redirect()->back()->with('message', 'Invalid word using given letters!');
        }
    
        // Update used words
        $usedWords[] = $word;
        session()->set('used_words', $usedWords);
    
        // Increase score
        $score += strlen($word);
        session()->set('score', $score); 
    
        // Update available letters
        session()->set('available_letters', $this->removeUsedLetters(strtolower($word), $letters));
    
        return redirect()->back()->with('message', "Word accepted! Score: " . session()->get('score'));
    }
    
    
    /**
     * Validate word from words.txt
     */
    private function isValidWordFromFile($word) {
        $filePath = FCPATH . 'words.txt'; // Full path to words.txt
    
        if (!file_exists($filePath)) {
            return false; // File does not exist
        }
    
        $words = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        return in_array($word, $words);
    }
    
    

    private function generateRandomString($length = 5) {
        $characters = 'STONE';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

    private function canConstructWord($word, $letters) {
        $letterArray = array_count_values(str_split($letters)); // Count available letters
        $wordArray = array_count_values(str_split($word)); // Count needed letters
    
        foreach ($wordArray as $char => $count) {
            if (!isset($letterArray[$char]) || $letterArray[$char] < $count) {
                return false; // Not enough occurrences of this letter
            }
        }
        return true;
    }  
    

    private function removeUsedLetters($word, $letters) {
        foreach (str_split($word) as $char) {
            $letters = preg_replace("/$char/", '', $letters, 1);
        }
        return $letters;
    }

    public function showHighScores() {
        $gameModel = new GameModel();
        $data['highScores'] = $gameModel->getTopScores();
        return view('high_scores', $data);
    }
}
