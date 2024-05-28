<?php
// src/Entity/Article.php
namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_de_publication = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbr_likes = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbr_comments = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, Save>
     */
    #[ORM\OneToMany(targetEntity: Save::class, mappedBy: 'cancel')]
    private Collection $saves;

    public function __construct()
    {
        $this->saves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->date_de_publication;
    }

    public function setDateDePublication(\DateTimeInterface $date_de_publication): static
    {
        $this->date_de_publication = $date_de_publication;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getNbrLikes(): ?int
    {
        return $this->nbr_likes;
    }

    public function setNbrLikes(?int $nbr_likes): static
    {
        $this->nbr_likes = $nbr_likes;

        return $this;
    }

    public function getNbrComments(): ?int
    {
        return $this->nbr_comments;
    }

    public function setNbrComments(?int $nbr_comments): static
    {
        $this->nbr_comments = $nbr_comments;

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

    /**
     * @return Collection<int, Save>
     */
    public function getSaves(): Collection
    {
        return $this->saves;
    }

    public function addSave(Save $save): static
    {
        if (!$this->saves->contains($save)) {
            $this->saves->add($save);
            $save->setCancel($this);
        }

        return $this;
    }

    public function removeSave(Save $save): static
    {
        if ($this->saves->removeElement($save)) {
            // set the owning side to null (unless already changed)
            if ($save->getCancel() === $this) {
                $save->setCancel(null);
            }
        }

        return $this;
    }
}
