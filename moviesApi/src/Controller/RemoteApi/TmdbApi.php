<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 22/02/2020
 * Time: 17:12
 */

namespace App\Controller\RemoteApi;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class TmdbApi
 * @package App\Controller
 */
class TmdbApi extends AbstractController
{
    /** Tmdb Api key
     * @var string
     */
    protected $apiKey = '15c36cbe9b5589d67b3b6d722c34cddc';

    /**
     * @param $movieName
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovie($movieName) {
        $client = HttpClient::create();
        return json_decode($client->request('GET', 'https://api.themoviedb.org/3/search/movie?api_key='.$this->apiKey.'&query='.$movieName)->getContent());
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovies() {
        $client = HttpClient::create();
        return json_decode($client->request('GET', 'https://api.themoviedb.org/3/movie/top_rated?api_key='.$this->apiKey.'&language=en-US&page=1')->getContent());
    }
}