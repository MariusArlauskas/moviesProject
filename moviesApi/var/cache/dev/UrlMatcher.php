<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
        '/api/logout' => [[['_route' => 'logout', '_controller' => 'App\\Controller\\ProfileController::logout'], null, null, null, false, false, null]],
        '/api/movies' => [
            [['_route' => 'movies_apimovies', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMovies'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'movies_apimovies_add', '_controller' => 'App\\Controller\\EntityController\\MoviesController::addMovies'], null, ['POST' => 0], null, false, false, null],
        ],
        '/api/users' => [[['_route' => 'user_create', '_controller' => 'App\\Controller\\EntityController\\UserController::createAction'], null, ['POST' => 0], null, false, false, null]],
        '/api/profile' => [[['_route' => 'current_user_data', '_controller' => 'App\\Controller\\ProfileController::getAction'], null, ['GET' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'user_create_register_controller', '_controller' => 'App\\Controller\\RegisterController::register'], null, null, null, false, false, null]],
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
                .'|/(.*)?(*:99)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        64 => [[['_route' => 'movies_apimovie', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMovie'], ['movieName'], ['GET' => 0], null, false, true, null]],
        84 => [
            [['_route' => 'movies_apimovies_put', '_controller' => 'App\\Controller\\EntityController\\MoviesController::updateMovies'], ['id'], ['PUT' => 0], null, false, true, null],
            [['_route' => 'movies_apimovies_delete', '_controller' => 'App\\Controller\\EntityController\\MoviesController::deleteMovies'], ['id'], ['DELETE' => 0], null, false, true, null],
        ],
        99 => [
            [['_route' => 'pageNotFound', '_controller' => 'App\\Controller\\PageNotFoundController::pageNotFoundAction', 'path' => ''], ['path'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
