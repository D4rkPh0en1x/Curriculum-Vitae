<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SelfEvaluationRepository")
 */
class SelfEvaluation
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
    private $brandapplication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $product;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SelfEvaluationCategories", inversedBy="selfEvaluations")
     */
    private $categorie;


 
    public function __construct()
    {
        $this->evalCategories = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBrandapplication(): ?string
    {
        return $this->brandapplication;
    }

    public function setBrandapplication(?string $brandapplication): self
    {
        $this->brandapplication = $brandapplication;

        return $this;
    }

    public function getProduct(): ?string
    {
        return $this->product;
    }

    public function setProduct(?string $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getEvaluation(): ?int
    {
        return $this->evaluation;
    }

    public function setEvaluation(?int $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getCategorie(): ?SelfEvaluationCategories
    {
        return $this->categorie;
    }

    public function setCategorie(?SelfEvaluationCategories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }




}
