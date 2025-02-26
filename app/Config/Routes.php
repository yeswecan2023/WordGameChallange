<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

/** @var RouteCollection $routes */
$routes->get('/wordgame', 'WordGame::index');
$routes->match(['get', 'post'], '/wordgame/startGame', 'WordGame::startGame');
$routes->post('/wordgame/submitWord', 'WordGame::submitWord');
$routes->get('/wordgame/highscores', 'WordGame::showHighScores');


$routes->get('clear-cache', function() {
    \Config\Services::cache()->clean();
    return 'Cache cleared!';
});