<?php

namespace App\Entity;

use App\Repository\ContactPersonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactPersonRepository::class)
 */
class ContactPerson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $streetnumber;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\Length(min=5, max=5)
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $contacted = false;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $contactDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tested;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getStreetnumber(): ?string
    {
        return $this->streetnumber;
    }

    public function setStreetnumber(string $streetnumber): self
    {
        $this->streetnumber = $streetnumber;

        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getContacted(): ?bool
    {
        return $this->contacted;
    }

    public function setContacted(bool $contacted): self
    {
        $this->contacted = $contacted;

        return $this;
    }

    public function getContactDate(): ?\DateTimeInterface
    {
        return $this->contactDate;
    }

    public function setContactDate(?\DateTimeInterface $contactDate): self
    {
        $this->contactDate = $contactDate;

        return $this;
    }

    public function getTested(): ?bool
    {
        return $this->tested;
    }

    public function setTested(bool $tested): self
    {
        $this->tested = $tested;

        return $this;
    }
}
