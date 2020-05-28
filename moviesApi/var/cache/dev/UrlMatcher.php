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
        '/api/genres' => [[['_route' => 'genres_get', '_controller' => 'App\\Controller\\EntityController\\GenresController::getAllAction'], null, ['GET' => 0], null, false, false, null]],
        '/api/messages' => [[['_route' => 'message_create', '_controller' => 'App\\Controller\\EntityController\\MessagesController::createAction'], null, ['POST' => 0], null, false, false, null]],
        '/api/movies/find' => [[['_route' => 'find_movie', '_controller' => 'App\\Controller\\EntityController\\MoviesController::findMovie'], null, ['POST' => 0], null, false, false, null]],
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
                        .'|essages/(?'
                            .'|(\\d+)(*:70)'
                            .'|([^/]++)/(\\d+)(*:91)'
                        .')'
                        .'|ovies/(?'
                            .'|([^/]++)/page/(?'
                                .'|(\\d+)/user/(\\d+)(*:141)'
                                .'|(\\d+)(*:154)'
                            .')'
                            .'|(\\d+)(*:168)'
                            .'|webMostPopular/page/(\\d+)/(\\w)(?:/(\\d+))?(*:217)'
                            .'|(\\d+)/messages/(\\d+)(*:245)'
                        .')'
                    .')'
                    .'|users/(?'
                        .'|(\\d+)/update(*:276)'
                        .'|(\\d+)/updateRole(*:300)'
                        .'|(\\d+)(*:313)'
                        .'|(\\d+)/apis/(\\d+)/movies/(\\d+)/status/(\\d+)(*:363)'
                        .'|(\\d+)/apis/(\\d+)/movies/(\\d+)/rating/(\\d+)(*:413)'
                        .'|(\\d+)/movies(*:433)'
                        .'|(\\d+)/messages/(\\d+)(*:461)'
                    .')'
                    .'|profile/(?'
                        .'|([^/]++)(*:489)'
                        .'|(\\d+)/update(*:509)'
                    .')'
                .')'
                .'|/(.*)?(*:525)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        70 => [[['_route' => 'message_delete', '_controller' => 'App\\Controller\\EntityController\\MessagesController::deleteAction'], ['id'], ['POST' => 0], null, false, true, null]],
        91 => [[['_route' => 'messages_get', '_controller' => 'App\\Controller\\EntityController\\MessagesController::getAllAction'], ['elementNumber', 'lastId'], ['GET' => 0], null, false, true, null]],
        141 => [[['_route' => 'movies_with_favorites_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMoviesWithFavorites'], ['type', 'pageNumber', 'userId'], ['POST' => 0], null, false, true, null]],
        154 => [[['_route' => 'movies_get', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMovies'], ['type', 'pageNumber'], ['POST' => 0], null, false, true, null]],
        168 => [[['_route' => 'movie_show_one', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getOneAction'], ['id'], ['GET' => 0], null, false, true, null]],
        217 => [[['_route' => 'movies_get_most_popular_web', 'userId' => 0, '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMostPopularMoviesInWeb'], ['pageNumber', 'type', 'userId'], ['GET' => 0], null, false, true, null]],
        245 => [[['_route' => 'movie_get_messages_list', '_controller' => 'App\\Controller\\EntityController\\MoviesController::getMovieMessages'], ['id', 'elementNumber'], ['GET' => 0], null, false, true, null]],
        276 => [[['_route' => 'user_update', '_controller' => 'App\\Controller\\EntityController\\UsersController::updateAction'], ['id'], ['POST' => 0], null, false, false, null]],
        300 => [[['_route' => 'user_change_role', '_controller' => 'App\\Controller\\EntityController\\UsersController::changeRoleAction'], ['id'], ['POST' => 0], null, false, false, null]],
        313 => [[['_route' => 'user_show_one', '_controller' => 'App\\Controller\\EntityController\\UsersController::getOneAction'], ['id'], ['GET' => 0], null, false, true, null]],
        363 => [[['_route' => 'user_add_movie_to_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::addMovieStatus'], ['userId', 'apiId', 'movieId', 'relationType'], ['POST' => 0], null, false, true, null]],
        413 => [[['_route' => 'user_add_movie_rating', '_controller' => 'App\\Controller\\EntityController\\UsersController::addUsersRating'], ['userId', 'apiId', 'movieId', 'rating'], ['POST' => 0], null, false, true, null]],
        433 => [[['_route' => 'user_movies_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::getUsersMovies'], ['id'], ['GET' => 0], null, false, false, null]],
        461 => [[['_route' => 'user_get_messages_list', '_controller' => 'App\\Controller\\EntityController\\UsersController::getUsersMessages'], ['id', 'elementNumber'], ['GET' => 0], null, false, true, null]],
        489 => [[['_route' => 'user_profile_data', '_controller' => 'App\\Controller\\ProfileController::getAction'], ['id'], ['GET' => 0], null, false, true, null]],
        509 => [[['_route' => 'profile_update', '_controller' => 'App\\Controller\\ProfileController::updateProfile'], ['id'], ['POST' => 0], null, false, false, null]],
        525 => [
            [['_route' => 'pageNotFound', '_controller' => 'App\\Controller\\PageNotFoundController::pageNotFoundAction', 'path' => ''], ['path'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
