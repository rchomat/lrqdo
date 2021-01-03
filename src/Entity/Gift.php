<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GiftRepository")
 * @ORM\Table(indexes={@ORM\Index(name="gift_uuid_idx", columns={"uuid"})})
 * @ORM\Table(indexes={@ORM\Index(name="gift_code_idx", columns={"code"})})
 */
class Gift
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
    private string $code;

    /**
     * @ORM\Column(type="string")
     */
    private string $description;

    /**
     * @ORM\Column(type="string")
     */
    private $price;

    public function __construct(string $uuid, string $code, string $description, $price)
    {
        $this->uuid = $uuid;
        $this->code = $code;
        $this->description = $description;
        $this->price = $price;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }
}
