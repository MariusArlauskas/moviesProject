<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserMoviesRepository")
 * @ORM\Table(name="user_movies",
 *     indexes={
 *     		@ORM\Index(name="search_idx", columns={"relation_type", "user_id", "movie_id"})})
 */
class UserMovies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $relationType;

    /**
	 * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
	 * @ORM\Column(type="integer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $movieId;

    /**
     * @ORM\Column(type="integer")
     */
    private $apiId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isFavorite = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRelationType(): ?int
    {
        return $this->relationType;
    }

    public function setRelationType(int $relationType): self
    {
        $this->relationType = $relationType;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getMovieId(): ?int
    {
        return $this->movieId;
    }

    public function setMovieId(?int $movieId): self
    {
        $this->movieId = $movieId;

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

    public function getIsFavorite(): ?bool
    {
        return $this->isFavorite;
    }

    public function setIsFavorite(bool $isFavorite): self
    {
        $this->isFavorite = $isFavorite;

        return $this;
    }
}
