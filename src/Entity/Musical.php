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
     * @ORM\OneToMany(targetEntity=Favourite::class, mappedBy="musical")
     */
    private $favourites;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="musical")
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $filename;

    /**
     * Musical constructor.
     */
    public function __construct()
    {
        $this->songs = new ArrayCollection();
        $this->composer = new ArrayCollection();
        $this->actor = new ArrayCollection();
        $this->favourites = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    /**
     * @return Collection|Favourite[]
     */
    public function getFavourites(): Collection
    {
        return $this->favourites;
    }

    /**
     * @param Favourite $favourite
     */
    public function addFavourite(Favourite $favourite): void
    {
        if (!$this->favourites->contains($favourite)) {
            $this->favourites[] = $favourite;
            $favourite->setMusical($this);
        }
    }

    /**
     * @param Favourite $favourite
     */
    public function removeFavourite(Favourite $favourite): void
    {
        if ($this->favourites->removeElement($favourite)) {
            // set the owning side to null (unless already changed)
            if ($favourite->getMusical() === $this) {
                $favourite->setMusical(null);
            }
        }
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     */
    public function addComment(Comment $comment): void
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setMusical($this);
        }
    }

    /**
     * @param Comment $comment
     */
    public function removeComment(Comment $comment): void
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMusical() === $this) {
                $comment->setMusical(null);
            }
        }
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }
}
