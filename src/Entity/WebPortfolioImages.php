<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebPortfolioImagesRepository")
 */
class WebPortfolioImages
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WebPortfolio", inversedBy="webPortfolioImages")
     */
    private $webportfolio;

    public function getId()
    {
        return $this->id;
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

    public function getWebportfolio(): ?WebPortfolio
    {
        return $this->webportfolio;
    }

    public function setWebportfolio(?WebPortfolio $webportfolio): self
    {
        $this->webportfolio = $webportfolio;

        return $this;
    }
}
