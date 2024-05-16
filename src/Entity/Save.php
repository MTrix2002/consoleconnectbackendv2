<?php

namespace App\Entity;

use App\Repository\SaveRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaveRepository::class)]
class Save
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $SaveAt = null;

    #[ORM\ManyToOne(inversedBy: 'saves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $article = null;

    #[ORM\ManyToOne(inversedBy: 'saves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $cancel = null;

    #[ORM\ManyToOne(inversedBy: 'saves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSaveAt(): ?\DateTimeImmutable
    {
        return $this->SaveAt;
    }

    public function setSaveAt(\DateTimeImmutable $SaveAt): static
    {
        $this->SaveAt = $SaveAt;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getCancel(): ?Article
    {
        return $this->cancel;
    }

    public function setCancel(?Article $cancel): static
    {
        $this->cancel = $cancel;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
