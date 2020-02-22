<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/movies' => [
            [['_route' => 'movies_apimovies', '_controller' => 'App\\Controller\\MoviesController::getMovies'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'movies_apimovies_add', '_controller' => 'App\\Controller\\MoviesController::addMovies'], null, ['POST' => 0], null, false, false, null],
        ],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/movie(?'
                    .'|/([^/]++)(*:64)'
                    .'|s/([^/]++)(?'
                        .'|(*:84)'
                    .')'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        64 => [[['_route' => 'movies_apimovie', '_controller' => 'App\\Controller\\MoviesController::getMovie'], ['movieName'], ['GET' => 0], null, false, true, null]],
        84 => [
            [['_route' => 'movies_apimovies_put', '_controller' => 'App\\Controller\\MoviesController::updateMovies'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'movies_apimovies_delete', '_controller' => 'App\\Controller\\MoviesController::deleteMovies'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
