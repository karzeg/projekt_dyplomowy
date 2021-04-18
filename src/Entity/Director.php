<?php
/**
 * Director entity.
 */

namespace App\Entity;

use App\Repository\DirectorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dierctor.
 *
 * @ORM\Entity(repositoryClass="App\Repository\DirectorRepository")
 * @ORM\Table(name="directors")
 */
class Director
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
     * Musical.
     *
     * @ORM\ManyToMany(targetEntity=Musical::class, mappedBy="director")
     */
    private $musicals;

    /**
     * Director constructor.
     */
    public function __construct()
    {
        $this->musicals = new ArrayCollection();
    }

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

    /**
     * Getter for Musical.
     *
     * @return Collection|Musical[] Musical
     */
    public function getMusicals(): Collection
    {
        return $this->musicals;
    }

    /**
     * Adder for Musical.
     *
     * @param Musical $musical Musical
     *
     * @return $this
     */
    public function addMusical(Musical $musical): self
    {
        if (!$this->musicals->contains($musical)) {
            $this->musicals[] = $musical;
            $musical->addDirector($this);
        }

        return $this;
    }

    /**
     * Remover for Musical.
     *
     * @param Musical $musical Musical
     *
     * @return $this
     */
    public function removeMusical(Musical $musical): self
    {
        if ($this->musicals->removeElement($musical)) {
            $musical->removeDirector($this);
        }

        return $this;
    }
}
