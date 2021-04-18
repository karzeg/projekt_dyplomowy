<?php
/**
 * Actor entity.
 */

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * Musical.
     *
     * @ORM\ManyToMany(targetEntity=Musical::class, mappedBy="actor")
     */
    private $musicals;

    /**
     * Song.
     *
     * @ORM\ManyToMany(targetEntity=Song::class, mappedBy="actor")
     */
    private $songs;

    /**
     * Actor constructor.
     */
    public function __construct()
    {
        $this->musicals = new ArrayCollection();
        $this->songs = new ArrayCollection();
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
            $musical->addActor($this);
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
            $musical->removeActor($this);
        }

        return $this;
    }

    /**
     * Getter for Song.
     *
     * @return Collection|Song[] Song
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    /**
     * Adder for Song.
     *
     * @param Song $song Song
     *
     * @return $this
     */
    public function addSong(Song $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs[] = $song;
            $song->addActor($this);
        }

        return $this;
    }

    /**
     * Remover for Song.
     *
     * @param Song $song Song
     *
     * @return $this
     */
    public function removeSong(Song $song): self
    {
        if ($this->songs->removeElement($song)) {
            $song->removeActor($this);
        }

        return $this;
    }
}
