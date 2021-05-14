<?php
/**
 * Composer entity.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Composer.
 *
 * @ORM\Entity(repositoryClass="App\Repository\ComposerRepository")
 * @ORM\Table(name="composers")
 */
class Composer
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
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(min="3", max="200")
     */
    private $name;

    /**
     * Biography.
     *
     * @var string
     *
     * @ORM\Column(type="text", nullable=true, length=65535)
     *
     * @Assert\Type(type="text")
     * @Assert\Length(min="1", max="65535")
     */
    private $bio;

    /**
     * Musical.
     *
     * @ORM\ManyToMany(targetEntity=Musical::class, mappedBy="composer")
     */
    private $musicals;

    /**
     * Composer constructor.
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
            $musical->addComposer($this);
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
            $musical->removeComposer($this);
        }

        return $this;
    }
}
