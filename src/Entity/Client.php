<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(min=4, max=20)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Length(min=3, max=20)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\Length(min=9, max=14)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

   /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheService", mappedBy="codeClient")
     */
    private $ficheservices;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function __construct()
    {
        $this->ficheservices = new ArrayCollection();
    }

    /**
     * @return Collection|FicheService[]
     */
    public function getFicheservices(): Collection
    {
        return $this->ficheservices;
    }

    public function getSlug() : string {
        return (new Slugify())->slugify($this->getName());
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank([
            'payload' => ['severity' => 'error'],
        ]));
        $metadata->addPropertyConstraint('lastName', new Assert\NotBlank([
            'payload' => ['severity' => 'error'],
        ]));
       
        $metadata->addPropertyConstraint('address', new Assert\NotBlank([
            'payload' => ['severity' => 'error'],
        ]));
        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'The email "{{ value }}" is not a valid email.',
        ]));
    }
   
}
