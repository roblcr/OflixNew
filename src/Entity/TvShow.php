<?php

namespace App\Entity;

use App\Repository\TvShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TvShowRepository::class)
 */
class TvShow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tvshows"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
       * @Groups({"tvshows"}), @Groups({"categories"}), @Groups({"characters"})

     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
      * @Groups({"tvshows"})
     */
    private $synospis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
       * @Groups({"tvshows"})
     */
    private $image;

    /**
     * @ORM\Column(type="integer", nullable=true)
       * @Groups({"tvshows"})
     */
    private $nbLikes;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Season::class, mappedBy="tvShow")
       * @Groups({"tvshows"})
     */
    private $Season;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="tvShows")
       * @Groups({"tvshows"})
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity=Character::class, inversedBy="tvShows")
     * @Groups({"tvshows"})
     */
    private $persona;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    public function __construct()
    {
        $this->Season = new ArrayCollection();
        $this->category = new ArrayCollection();
        $this->persona = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSynospis(): ?string
    {
        return $this->synospis;
    }

    public function setSynospis(?string $synospis): self
    {
        $this->synospis = $synospis;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getNbLikes(): ?int
    {
        return $this->nbLikes;
    }

    public function setNbLikes(?int $nbLikes): self
    {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Season[]
     */
    public function getSeason(): Collection
    {
        return $this->Season;
    }

    public function addSeason(Season $season): self
    {
        if (!$this->Season->contains($season)) {
            $this->Season[] = $season;
            $season->setTvShow($this);
        }

        return $this;
    }

    public function removeSeason(Season $season): self
    {
        if ($this->Season->removeElement($season)) {
            // set the owning side to null (unless already changed)
            if ($season->getTvShow() === $this) {
                $season->setTvShow(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    

    /**
     * @return Collection|Character[]
     */
    public function getPersona(): Collection
    {
        return $this->persona;
    }

    public function addPersona(Character $persona): self
    {
        if (!$this->persona->contains($persona)) {
            $this->persona[] = $persona;
        }

        return $this;
    }

    public function removePersona(Character $persona): self
    {
        $this->persona->removeElement($persona);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
