<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 22/02/2020
 * Time: 17:12
 */

namespace App\Controller\RemoteApis;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;

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
     * @return array|string
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getMovie($movieName) {
        $client = HttpClient::create();
        return json_decode($client->request('GET', 'https://api.themoviedb.org/3/search/movie?api_key='.$this->apiKey.'&query='.$movieName)->getContent());
    }
}