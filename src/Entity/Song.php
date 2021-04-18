<?php
/**
 * Song entity.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Song.
 *
 * @ORM\Entity("App\Repository\SongRepository")
 * @ORM\Table(name="songs")
 */
class Song
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
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * Musical.
     *
     * @ORM\ManyToOne(targetEntity=Musical::class, inversedBy="songs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $musical;

    /**
     * @ORM\ManyToMany(targetEntity=Actor::class, inversedBy="songs")
     */
    private $actor;

    /**
     * Song constructor.
     */
    public function __construct()
    {
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
     * Getter for Musical.
     *
     * @return Musical|null Musical
     */
    public function getMusical(): ?Musical
    {
        return $this->musical;
    }

    /**
     * Setter for Musical.
     *
     * @param Musical|null $musical Musical
     *
     * @return $this
     */
    public function setMusical(?Musical $musical): self
    {
        $this->musical = $musical;

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
     * @param Actor $actor
     *
     * @return $this
     */
    public function removeActor(Actor $actor): self
    {
        $this->actor->removeElement($actor);

        return $this;
    }
}
