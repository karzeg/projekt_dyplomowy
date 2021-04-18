<?php
/**
 * Actor entity.
 */

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Actor.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ActorRepository")
 * @ORM\Table(name="actors")
 */
class Actor
{
    /**
     * Primary key.
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Name.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * Biography.
     *
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, length=65535)
     */
    private $bio;

    /**
     * Getter for Id.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Name.
     *
     * @return string|null Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter for Name.
     *
     * @param string $name Name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Getter for Bio.
     *
     * @return string|null Bio
     */
    public function getBio(): ?string
    {
        return $this->bio;
    }

    /**
     * Setter for Bio.
     *
     * @param string|null $bio Bio
     */
    public function setBio(?string $bio): void
    {
        $this->bio = $bio;
    }
}
