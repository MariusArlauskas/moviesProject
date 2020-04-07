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
        '/api/users' => [[['_route' => 'user_create', '_controller' => 'App\\Controller\\EntityController\\UserController::createAction'], null, ['POST' => 0], null, false, false, null]],
        '/api/lists/types' => [[['_route' => 'movie_add_types_get', '_controller' => 'App\\Controller\\EntityController\\UserMoviesRelationTypesController::getAllAction'], null, ['GET' => 0], null, false, false, null]],
        '/api/profile' => [[['_route' => 'current_user_profile_data', '_controller' => 'App\\Controller\\ProfileController::getSelfAction'], null, ['GET' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'user_create_register_controller', '_controller' => 'App\\Controller\\RegisterController::register'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|movies/(?'
                        .'|page/(?'
                            .'|(\\d+)/user/(\\d+)(*:84)'
                            .'|(\\d+)(*:96)'
                        .')'
                        .'|(\\d+)(*:109)'
                    .')'
                    .'|users/(?'
                        .'|(\\d+)(*:132)'
                        .'|(\\d+)/apis/(\\d+)/movies/(\\d+)/status/(\\d+)(*:182)'
                    .')'
                    .'|profile/([^/]++)(*:207)'
                .')'
                .'|/(.*)?(*:222)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        84 => [[['_route' => 'movies_apimovies_with_favorites_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMoviesWithFavorites'], ['pageNumber', 'userId'], ['GET' => 0], null, false, true, null]],
        96 => [[['_route' => 'movies_apimovies_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMovies'], ['pageNumber'], ['GET' => 0], null, false, true, null]],
        109 => [[['_route' => 'movies_apimovie_show_one', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getOneFromDbAction'], ['id'], ['GET' => 0], null, false, true, null]],
        132 => [[['_route' => 'user_show_one', '_controller' => 'App\\Controller\\EntityController\\UserController::getOneAction'], ['id'], ['GET' => 0], null, false, true, null]],
        182 => [[['_route' => 'user_add_movie', '_controller' => 'App\\Controller\\EntityController\\UserController::addMovieStatus'], ['userId', 'apiId', 'movieId', 'relationType'], ['POST' => 0], null, false, true, null]],
        207 => [[['_route' => 'user_profile_data', '_controller' => 'App\\Controller\\ProfileController::getAction'], ['id'], ['GET' => 0], null, false, true, null]],
        222 => [
            [['_route' => 'pageNotFound', '_controller' => 'App\\Controller\\PageNotFoundController::pageNotFoundAction', 'path' => ''], ['path'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
