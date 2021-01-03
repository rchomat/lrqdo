<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReceiverRepository")
 * @ORM\Table(indexes={@ORM\Index(name="receiver_uuid_idx", columns={"uuid"})})
 */
class Receiver
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="guid", nullable=false, unique=true)
     */
    private string $uuid;

    /**
     * @ORM\Column(type="string")
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string")
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string")
     */
    private string $countryCode;

    /**
     * @ORM\ManyToMany(targetEntity="Gift")
     */
    private $gifts;

    public function __construct(string $uuid, string $firstName, string $lastName, string $countryCode)
    {
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->countryCode = $countryCode;
        $this->gifts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getGifts()
    {
        return $this->gifts;
    }

    public function addGift(Gift $gift): self
    {
        if (false === $this->gifts->contains($gift)) {
            $this->gifts->add($gift);
        }

        return $this;
    }

    public function removeGift(Gift $gift)
    {
        $this->gifts->removeElement($gift);
    }
}
