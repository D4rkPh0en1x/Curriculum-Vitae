<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebPortfolioRepository")
 */
class WebPortfolio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $technic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\WebPortfolioImages", mappedBy="webportfolio")
     */
    private $webPortfolioImages;

    public function __construct()
    {
        $this->webPortfolioImages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTechnic(): ?string
    {
        return $this->technic;
    }

    public function setTechnic(?string $technic): self
    {
        $this->technic = $technic;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return Collection|WebPortfolioImages[]
     */
    public function getWebPortfolioImages(): Collection
    {
        return $this->webPortfolioImages;
    }

    public function addWebPortfolioImage(WebPortfolioImages $webPortfolioImage): self
    {
        if (!$this->webPortfolioImages->contains($webPortfolioImage)) {
            $this->webPortfolioImages[] = $webPortfolioImage;
            $webPortfolioImage->setWebportfolio($this);
        }

        return $this;
    }

    public function removeWebPortfolioImage(WebPortfolioImages $webPortfolioImage): self
    {
        if ($this->webPortfolioImages->contains($webPortfolioImage)) {
            $this->webPortfolioImages->removeElement($webPortfolioImage);
            // set the owning side to null (unless already changed)
            if ($webPortfolioImage->getWebportfolio() === $this) {
                $webPortfolioImage->setWebportfolio(null);
            }
        }

        return $this;
    }
}
