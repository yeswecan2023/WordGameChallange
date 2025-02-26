<?php

namespace App\Models;
use CodeIgniter\Model;

class GameModel extends Model
{
    protected $table = 'scores';
    protected $primaryKey = 'id';
    protected $allowedFields = ['player_name', 'score', 'created_at'];

    public function getTopScores($limit = 10) {
        return $this->orderBy('score', 'DESC')->limit($limit)->find();
    }

    public function saveScore($playerName, $score) {
        return $this->insert([
            'player_name' => $playerName,
            'score' => $score,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
