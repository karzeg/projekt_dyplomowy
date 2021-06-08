<?php
/**
 * Comment entity.
 */

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use PHP_CodeSniffer\Tests\Core\File\testFECNExtendedClass;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ORM\Table(name="comments")
 */
class Comment
{
    /**
     * Id.
     *
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Content
     *
     * @var string
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Musical::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $musical;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $author;

    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
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

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     */
    public function setAuthor(?User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /**
     * @param DateTimeInterface $date
     */
    public function setDate(DateTimeInterface $date): void
    {
        $this->date = $date;
    }
}
