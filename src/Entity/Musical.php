<?php
/**
 * Musical entity.
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $title;

    /**
     * Year.
     *
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * Description.
     *
     * @var string
     *
     * @ORM\Column(type="text",
     *     length=65535)
     */
    private $description;

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
}
