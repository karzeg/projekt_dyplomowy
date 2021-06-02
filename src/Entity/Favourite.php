<?php
/**
 * Favourite entity.
 */

namespace App\Entity;

use App\Repository\FavouriteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FavouriteRepository")
 * @ORM\Table(name="favourites")
 */
class Favourite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Musical::class, inversedBy="favourites")
     */
    private $musical;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Musical|null
     */
    public function getMusical(): ?Musical
    {
        return $this->musical;
    }

    /**
     * @param Musical|null $musical
     */
    public function setMusical(?Musical $musical): void
    {
        $this->musical = $musical;
    }
}
