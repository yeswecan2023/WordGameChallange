<?php

namespace App\Libraries;

class WordValidator {
    public function isValidWord($word) {
        // Example validation: You can replace this with an actual dictionary API
        return ctype_alpha($word) && strlen($word) > 2;
    }
}
