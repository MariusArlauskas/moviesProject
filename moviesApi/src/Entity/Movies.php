<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MoviesRepository")
 */
class Movies
{
    /**
     * @ORM\Id()
	 * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $overview;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $posterPath;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $originalTitle;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="integer")
     */
    private $apiId;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $movieId;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $genres = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mostPopular;

    public function __construct($arr = [])
    {
    	if (!empty($arr)) {
			// Initializing class properties
			foreach($arr as $property => $value) {
				if ($property == 'releaseDate') {
					$value = \DateTime::createFromFormat('Y-m-d', $value);
				}
				$this->$property = $value;
			}
		}
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(?string $posterPath): self
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    public function getOriginalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getApiId(): ?int
    {
        return $this->apiId;
    }

    public function setApiId(int $apiId): self
    {
        $this->apiId = $apiId;

        return $this;
    }

	public function getMovieId(): ?int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): self
    {
        $this->movieId = $movieId;

        return $this;
    }

    public function getGenres(): ?array
    {
        return $this->genres;
    }

    public function setGenres(?array $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

	public function toArray() {
		$vars = get_object_vars ( $this );
		$array = array ();
		foreach ( $vars as $key => $value ) {
			$skip = false;
			switch ($key) {
				case 'releaseDate':
					if (!empty($value)) {
						$value = $value->format('Y-m-d');
					} else {
						$value = '';
					}
					break;
				case 'genres':
					if (is_array($value)) {
						$value = implode(', ', $value);
					} else {
						preg_match_all('/"(.*?)"/', $value, $temp);
						array_shift($temp);
						$value = join(', ', $temp[0]);
					}
			}
			if ($skip) {
				continue;
			}

			$array [ltrim ( $key, '_' )] = $value;
		}
		return $array;
	}

    public function getMostPopular(): ?int
    {
        return $this->mostPopular;
    }

    public function setMostPopular(?int $mostPopular): self
    {
        $this->mostPopular = $mostPopular;

        return $this;
    }
}
