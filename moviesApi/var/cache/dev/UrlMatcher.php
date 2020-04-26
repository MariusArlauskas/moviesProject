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
        '/api/users' => [
            [['_route' => 'user_create', '_controller' => 'App\\Controller\\EntityController\\UsersController::createAction'], null, ['POST' => 0], null, false, false, null],
            [['_route' => 'user_show_all', '_controller' => 'App\\Controller\\EntityController\\UsersController::getAllAction'], null, ['GET' => 0], null, false, false, null],
        ],
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
                            .'|webMostPopular/page/(\\d+)/(\\w)(?:/(\\d+))?(*:192)'
                        .')'
                    .')'
                    .'|users/(?'
                        .'|(\\d+)/update(*:223)'
                        .'|(\\d+)/updateRole(*:247)'
                        .'|(\\d+)(*:260)'
                        .'|(\\d+)/apis/(\\d+)/movies/(\\d+)/status/(\\d+)(*:310)'
                        .'|(\\d+)/apis/(\\d+)/movies/(\\d+)/rating/(\\d+)(*:360)'
                        .'|(\\d+)/movies(*:380)'
                        .'|(\\d+)/messages/(\\d+)(*:408)'
                    .')'
                    .'|profile/(?'
                        .'|([^/]++)(*:436)'
                        .'|(\\d+)/update(*:456)'
                    .')'
                .')'
                .'|/(.*)?(*:472)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        76 => [[['_route' => 'messages_get', '_controller' => 'App\\Controller\\EntityController\\MessagesController::getAllAction'], ['elementNumber', 'lastId'], ['GET' => 0], null, false, true, null]],
        116 => [[['_route' => 'movies_with_favorites_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMoviesWithFavorites'], ['pageNumber', 'userId'], ['GET' => 0], null, false, true, null]],
        129 => [[['_route' => 'movies_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMovies'], ['pageNumber'], ['GET' => 0], null, false, true, null]],
        143 => [[['_route' => 'movie_show_one', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getOneAction'], ['id'], ['GET' => 0], null, false, true, null]],
        192 => [[['_route' => 'movies_get_most_popular_web', 'userId' => 0, '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMostPopularMoviesInWeb'], ['pageNumber', 'type', 'userId'], ['GET' => 0], null, false, true, null]],
        223 => [[['_route' => 'user_update', '_controller' => 'App\\Controller\\EntityController\\UsersController::updateAction'], ['id'], ['POST' => 0], null, false, false, null]],
        247 => [[['_route' => 'user_change_role', '_controller' => 'App\\Controller\\EntityController\\UsersController::changeRoleAction'], ['id'], ['POST' => 0], null, false, false, null]],
        260 => [[['_route' => 'user_show_one', '_controller' => 'App\\Controller\\EntityController\\UsersController::getOneAction'], ['id'], ['GET' => 0], null, false, true, null]],
        310 => [[['_route' => 'user_add_movie_to_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::addMovieStatus'], ['userId', 'apiId', 'movieId', 'relationType'], ['POST' => 0], null, false, true, null]],
        360 => [[['_route' => 'user_add_movie_rating', '_controller' => 'App\\Controller\\EntityController\\UsersController::addUsersRating'], ['userId', 'apiId', 'movieId', 'rating'], ['POST' => 0], null, false, true, null]],
        380 => [[['_route' => 'user_movies_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::getUsersMovies'], ['id'], ['GET' => 0], null, false, false, null]],
        408 => [[['_route' => 'user_get_messages_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::getUsersMessages'], ['id', 'elementNumber'], ['GET' => 0], null, false, true, null]],
        436 => [[['_route' => 'user_profile_data', '_controller' => 'App\\Controller\\ProfileController::getAction'], ['id'], ['GET' => 0], null, false, true, null]],
        456 => [[['_route' => 'profile_update', '_controller' => 'App\\Controller\\ProfileController::updateProfile'], ['id'], ['POST' => 0], null, false, false, null]],
        472 => [
            [['_route' => 'pageNotFound', '_controller' => 'App\\Controller\\PageNotFoundController::pageNotFoundAction', 'path' => ''], ['path'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
