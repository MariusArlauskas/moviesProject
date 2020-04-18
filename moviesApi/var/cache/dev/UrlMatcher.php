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
        '/api/messages' => [[['_route' => 'message_create', '_controller' => 'App\\Controller\\EntityController\\MessagesController::createAction'], null, ['POST' => 0], null, false, false, null]],
        '/api/users' => [[['_route' => 'user_create', '_controller' => 'App\\Controller\\EntityController\\UsersController::createAction'], null, ['POST' => 0], null, false, false, null]],
        '/api/lists/types' => [[['_route' => 'movie_add_types_get', '_controller' => 'App\\Controller\\EntityController\\UsersMoviesRelationTypesController::getAllAction'], null, ['GET' => 0], null, false, false, null]],
        '/api/profile' => [[['_route' => 'current_user_profile_data', '_controller' => 'App\\Controller\\ProfileController::getSelfAction'], null, ['GET' => 0], null, false, false, null]],
        '/api/register' => [[['_route' => 'user_create_register_controller', '_controller' => 'App\\Controller\\RegisterController::register'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/(?'
                    .'|m(?'
                        .'|essages/([^/]++)/(\\d+)(*:76)'
                        .'|ovies/(?'
                            .'|page/(?'
                                .'|(\\d+)/user/(\\d+)(*:116)'
                                .'|(\\d+)(*:129)'
                            .')'
                            .'|(\\d+)(*:143)'
                        .')'
                    .')'
                    .'|users/(?'
                        .'|(\\d+)(*:167)'
                        .'|(\\d+)/apis/(\\d+)/movies/(\\d+)/status/(\\d+)(*:217)'
                        .'|(\\d+)/apis/(\\d+)/movies/(\\d+)/rating/(\\d+)(*:267)'
                        .'|(\\d+)/movies(*:287)'
                        .'|(\\d+)/messages/(\\d+)(*:315)'
                    .')'
                    .'|profile/([^/]++)(*:340)'
                .')'
                .'|/(.*)?(*:355)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        76 => [[['_route' => 'messages_get', '_controller' => 'App\\Controller\\EntityController\\MessagesController::getAllAction'], ['elementNumber', 'lastId'], ['GET' => 0], null, false, true, null]],
        116 => [[['_route' => 'movies_with_favorites_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMoviesWithFavorites'], ['pageNumber', 'userId'], ['GET' => 0], null, false, true, null]],
        129 => [[['_route' => 'movies_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMovies'], ['pageNumber'], ['GET' => 0], null, false, true, null]],
        143 => [[['_route' => 'movie_show_one', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getOneAction'], ['id'], ['GET' => 0], null, false, true, null]],
        167 => [[['_route' => 'user_show_one', '_controller' => 'App\\Controller\\EntityController\\UsersController::getOneAction'], ['id'], ['GET' => 0], null, false, true, null]],
        217 => [[['_route' => 'user_add_movie_to_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::addMovieStatus'], ['userId', 'apiId', 'movieId', 'relationType'], ['POST' => 0], null, false, true, null]],
        267 => [[['_route' => 'user_add_movie_rating', '_controller' => 'App\\Controller\\EntityController\\UsersController::addUsersRating'], ['userId', 'apiId', 'movieId', 'rating'], ['POST' => 0], null, false, true, null]],
        287 => [[['_route' => 'user_movies_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::getUsersMovies'], ['id'], ['GET' => 0], null, false, false, null]],
        315 => [[['_route' => 'user_get_messages_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::getUsersMessages'], ['id', 'elementNumber'], ['GET' => 0], null, false, true, null]],
        340 => [[['_route' => 'user_profile_data', '_controller' => 'App\\Controller\\ProfileController::getAction'], ['id'], ['GET' => 0], null, false, true, null]],
        355 => [
            [['_route' => 'pageNotFound', '_controller' => 'App\\Controller\\PageNotFoundController::pageNotFoundAction', 'path' => ''], ['path'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
