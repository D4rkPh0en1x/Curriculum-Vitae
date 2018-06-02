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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mainimage;

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

  

    public function getMainimage(): ?string
    {
        return $this->mainimage;
    }

    public function setMainimage(?string $mainimage): self
    {
        $this->mainimage = $mainimage;

        return $this;
    }
}
