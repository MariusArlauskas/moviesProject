<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserMoviesRepository")
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
    private $relationTypeId;

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

    public function getRelationTypeId(): ?int
    {
        return $this->relationTypeId;
    }

    public function setRelationTypeId(int $relationTypeId): self
    {
        $this->relationTypeId = $relationTypeId;

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
