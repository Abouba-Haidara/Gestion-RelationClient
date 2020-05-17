<?php

namespace App\Entity;

use App\Entity\Client;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheServiceRepository")
 */
class FicheService
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="ficheservices")
     */
    private $codeClient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    public function getCodeClient(): ?Client
    {
        return $this->codeClient;
    }

    public function setCategory(?Client $codeClient): self
    {
        $this->codeClient = $codeClient;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}
