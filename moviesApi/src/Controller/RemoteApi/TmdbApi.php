<?php
/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 22/02/2020
 * Time: 17:12
 */

namespace App\Controller\RemoteApi;

use App\Entity\Apis;
use App\Entity\Movies;
use Doctrine\ORM\EntityManagerInterface;
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
    protected $apiKey = '';


	/**	Id in database
	 * @var int
	 */
	protected $apiId = 1;

	public function __construct(EntityManagerInterface $em)
	{
		$api = $em->getRepository(Apis::class);
		$this->apiKey = $api->find($this->apiId)->getApiKey();
	}

//    /**
//     * @param $movieName
//     * @return mixed
//     * @throws ClientExceptionInterface
//     * @throws RedirectionExceptionInterface
//     * @throws ServerExceptionInterface
//     * @throws TransportExceptionInterface
//     */
//    public function getMovie($movieName) {
//        $client = HttpClient::create();
//        return json_decode($client->request('GET', 'https://api.themoviedb.org/3/search/movie?api_key='.$this->apiKey.'&query='.$movieName)->getContent());
//    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getPopularMovies($page, $nr) {
        $client = HttpClient::create();
        return $this->returnMovies($client->request('GET', 'https://api.themoviedb.org/3/movie/popular?api_key='.$this->apiKey.'&language=en-US&page='.$page)->getContent(), 'MostPopular', $nr);
    }

    /**
     * @return mixed
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function getMovieGenres() {
        $client = HttpClient::create();
        return json_decode($client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?api_key='.$this->apiKey.'&language=en-US')->getContent());
    }

    protected function returnMovies($movies, $type, $nr) {
		$movies = json_decode($movies);
		try {
			$genres = $this->getMovieGenres();
		} catch (ClientExceptionInterface $e) {		// ??
		} catch (RedirectionExceptionInterface $e) {
		} catch (ServerExceptionInterface $e) {
		} catch (TransportExceptionInterface $e) {
		}
		$tmp = [];
		foreach ($genres->genres as $genre) {
			$tmp[$genre->id] = $genre->name;
		}
		$genres = $tmp;
		unset($tmp);

		// Converting genre_ids to genre names and adding for saving
		$moviesReturn = [];
		foreach ($movies->results as $id => $movie) {
			// Data to movie object for saving
			$temp = new Movies();
			$temp->setApiId($this->apiId);
			$temp->setMovieId($movie->id);
			$temp->setRating($movie->vote_average);
			$temp->setOriginalTitle($movie->original_title);
			$temp->setPosterPath('https://image.tmdb.org/t/p/w600_and_h900_bestv2'.$movie->poster_path);
			$temp->setOverview($movie->overview);
			if (!empty($movie->release_date)) {
				$temp->setReleaseDate(\DateTime::createFromFormat('Y-m-d', $movie->release_date));
			}
			$temp->setTitle($movie->title);
			if (!empty($type)) {
				$temp->{'set'.$type}($nr + $id + 1);
			}
			// From genres_ids to names
			$tmpArr = [];
			foreach ($movie->genre_ids as $genre_id) {
				 array_push($tmpArr, $genres[$genre_id]);
			}
			$temp->setGenres($tmpArr);

			$moviesReturn[] = $temp;
		}

		return $moviesReturn;
	}
}