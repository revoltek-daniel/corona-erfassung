<?php

namespace App\Entity;

use App\Repository\InfectedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InfectedRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class InfectedPerson
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
     * @Assert\Length(max=5, min=5)
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $quarantineStart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $quarantineEnd;

    /**
     * @ORM\Column(type="boolean")
     */
    private $positiveTest = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $inQuarantine = false;

    /**
     * @ORM\OneToMany(targetEntity=ContactPerson::class, mappedBy="InfectedPerson")
     */
    private $contactPersons;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $mailSendAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $salutation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactTrackingId;

    public function __construct()
    {
        $this->contactPersons = new ArrayCollection();
    }

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getQuarantineStart(): ?\DateTimeInterface
    {
        return $this->quarantineStart;
    }

    public function setQuarantineStart(?\DateTimeInterface $quarantineStart): self
    {
        $this->quarantineStart = $quarantineStart;

        return $this;
    }

    public function getQuarantineEnd(): ?\DateTimeInterface
    {
        return $this->quarantineEnd;
    }

    public function setQuarantineEnd(?\DateTimeInterface $quarantineEnd): self
    {
        $this->quarantineEnd = $quarantineEnd;

        return $this;
    }

    public function getPositiveTest(): ?bool
    {
        return $this->positiveTest;
    }

    public function setPositiveTest(bool $positiveTest): self
    {
        $this->positiveTest = $positiveTest;

        return $this;
    }

    public function getInQuarantine(): ?bool
    {
        return $this->inQuarantine;
    }

    public function setInQuarantine(bool $inQuarantine): self
    {
        $this->inQuarantine = $inQuarantine;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return InfectedPerson
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return InfectedPerson
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setModifiedAt(new \DateTime('now'));

        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * @return Collection|ContactPerson[]
     */
    public function getContactPersons(): Collection
    {
        return $this->contactPersons;
    }

    public function addContactPerson(ContactPerson $contactPerson): self
    {
        if (!$this->contactPersons->contains($contactPerson)) {
            $this->contactPersons[] = $contactPerson;
            $contactPerson->setInfectedPerson($this);
        }

        return $this;
    }

    public function removeContactPerson(ContactPerson $contactPerson): self
    {
        if ($this->contactPersons->removeElement($contactPerson)) {
            // set the owning side to null (unless already changed)
            if ($contactPerson->getInfectedPerson() === $this) {
                $contactPerson->setInfectedPerson(null);
            }
        }

        return $this;
    }

    public function getMailSendAt(): ?\DateTimeInterface
    {
        return $this->mailSendAt;
    }

    public function setMailSendAt(?\DateTimeInterface $mailSendAt): self
    {
        $this->mailSendAt = $mailSendAt;

        return $this;
    }

    public function getSalutation(): ?string
    {
        return $this->salutation;
    }

    public function setSalutation(string $salutation): self
    {
        $this->salutation = $salutation;

        return $this;
    }

    public function getContactTrackingId(): ?string
    {
        return $this->contactTrackingId;
    }

    public function setContactTrackingId(?string $contactTrackingId): self
    {
        $this->contactTrackingId = $contactTrackingId;

        return $this;
    }
}
