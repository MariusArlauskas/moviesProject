<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format'], ['variable', '/', '\\d+', 'code'], ['text', '/_error']], [], []],
    'movies_apimovies' => [[], ['_controller' => 'App\\Controller\\MoviesController::getMovies'], [], [['text', '/api/movies']], [], []],
    'movies_apimovie' => [['movieName'], ['_controller' => 'App\\Controller\\MoviesController::getMovie'], [], [['variable', '/', '[^/]++', 'movieName'], ['text', '/api/movie']], [], []],
    'movies_apimovies_add' => [[], ['_controller' => 'App\\Controller\\MoviesController::addMovies'], [], [['text', '/api/movies']], [], []],
    'movies_apimovies_put' => [['id'], ['_controller' => 'App\\Controller\\MoviesController::updateMovies'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/api/movies']], [], []],
    'movies_apimovies_delete' => [['id'], ['_controller' => 'App\\Controller\\MoviesController::deleteMovies'], [], [['variable', '/', '[^/]++', 'id'], ['text', '/api/movies']], [], []],
];
