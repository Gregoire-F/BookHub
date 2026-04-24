<?php

namespace App\Entity;

use App\Entity\Author;
use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['list', 'detail'])]
    private ?int $id = null;

    #[ORM\Column(length: 80, nullable: true)]
    #[Groups(['list', 'detail'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['list', 'detail'])]
    private ?\DateTime $year = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['detail'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'Book')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['list', 'detail'])]
    private ?Author $Author = null;

    #[ORM\ManyToOne(inversedBy: 'book')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['list', 'detail'])]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getYear(): ?\DateTime
    {
        return $this->year;
    }

    public function setYear(?\DateTime $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->Author;
    }

    public function setAuthor(?Author $Author): static
    {
        $this->Author = $Author;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
