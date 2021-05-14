<?php
/**
 * Musical entity.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Musical.
 *
 * @ORM\Entity(repositoryClass="App\Repository\MusicalRepository")
 * @ORM\Table(name="musicals")
 */
class Musical
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
     * Title.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(min="3", max="100")
     */
    private $title;

    /**
     * Year.
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     * @Assert\Type(type="int")
     */
    private $year;

    /**
     * Place.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(min="1", max="100")
     */
    private $place;

    /**
     * Description.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535)
     *
     * @Assert\Type(type="text")
     * @Assert\NotBlank
     * @Assert\Length(min="1", max="65535")
     */
    private $description;

    /**
     * History.
     *
     * @var string
     *
     * @ORM\Column(type="text", length=65535, nullable=true)
     *
     * @Assert\Type(type="text")
     * @Assert\Length(min="1", max="65535")
     */
    private $history;

    /**
     * Song.
     *
     * @ORM\OneToMany(targetEntity=Song::class, mappedBy="musical")
     */
    private $songs;

    /**
     * Director.
     *
     * @ORM\ManyToMany(targetEntity=Director::class, inversedBy="musical")
     */
    private $director;

    /**
     * Composer.
     *
     * @ORM\ManyToMany(targetEntity=Composer::class, inversedBy="musical")
     */
    private $composer;

    /**
     * @ORM\ManyToMany(targetEntity=Actor::class, inversedBy="musical")
     */
    private $actor;

    /**
     * Musical constructor.
     */
    public function __construct()
    {
        $this->songs = new ArrayCollection();
        $this->director = new ArrayCollection();
        $this->composer = new ArrayCollection();
        $this->actor = new ArrayCollection();
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
     * Getter for Title.
     *
     * @return string|null Title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter for Title.
     *
     * @param string $title Title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter for Year.
     *
     * @return int|null Year
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * Setter for Year.
     *
     * @param int $year Year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    /**
     * Getter for Description.
     *
     * @return string|null Description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Setter for Description.
     *
     * @param string $description Description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
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
            $song->setMusical($this);
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
            // set the owning side to null (unless already changed)
            if ($song->getMusical() === $this) {
                $song->setMusical(null);
            }
        }

        return $this;
    }

    /**
     * Getter for Director.
     *
     * @return Collection|Director[] Director
     */
    public function getDirector(): Collection
    {
        return $this->director;
    }

    /**
     * Adder for Director.
     *
     * @param Director $director Director
     *
     * @return $this
     */
    public function addDirector(Director $director): self
    {
        if (!$this->director->contains($director)) {
            $this->director[] = $director;
        }

        return $this;
    }

    /**
     * Remover for Director.
     *
     * @param Director $director Director
     *
     * @return $this
     */
    public function removeDirector(Director $director): self
    {
        $this->director->removeElement($director);

        return $this;
    }

    /**
     * Getter for Composer.
     *
     * @return Collection|Composer[] Composer
     */
    public function getComposer(): Collection
    {
        return $this->composer;
    }

    /**
     * Adder for Composer.
     *
     * @param Composer $composer Composer
     *
     * @return $this
     */
    public function addComposer(Composer $composer): self
    {
        if (!$this->composer->contains($composer)) {
            $this->composer[] = $composer;
        }

        return $this;
    }

    /**
     * Remover for Composer.
     *
     * @param Composer $composer Composer
     *
     * @return $this
     */
    public function removeComposer(Composer $composer): self
    {
        $this->composer->removeElement($composer);

        return $this;
    }

    /**
     * Getter for Actor.
     *
     * @return Collection|Actor[] Actor
     */
    public function getActor(): Collection
    {
        return $this->actor;
    }

    /**
     * Adder for Actor.
     *
     * @param Actor $actor Actor
     *
     * @return $this
     */
    public function addActor(Actor $actor): self
    {
        if (!$this->actor->contains($actor)) {
            $this->actor[] = $actor;
        }

        return $this;
    }

    /**
     * Remover for Actor.
     *
     * @param Actor $actor Actor
     *
     * @return $this
     */
    public function removeActor(Actor $actor): self
    {
        $this->actor->removeElement($actor);

        return $this;
    }

    /**
     * Getter for History.
     *
     * @return string|null History
     */
    public function getHistory(): ?string
    {
        return $this->history;
    }

    /**
     * Setter for History.
     *
     * @param string|null $history
     *
     * @return $this
     */
    public function setHistory(?string $history): self
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Getter for Place.
     *
     * @return string|null
     */
    public function getPlace(): ?string
    {
        return $this->place;
    }

    /**
     * Setter for Place.
     *
     * @param string $place
     *
     * @return $this
     */
    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }
}
