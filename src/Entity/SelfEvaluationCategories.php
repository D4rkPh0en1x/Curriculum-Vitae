<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SelfEvaluationCategoriesRepository")
 */
class SelfEvaluationCategories
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
     * @ORM\OneToMany(targetEntity="App\Entity\SelfEvaluation", mappedBy="categorie")
     */
    private $selfEvaluations;

    public function __construct()
    {
        $this->selfEvaluations = new ArrayCollection();
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

    /**
     * @return Collection|SelfEvaluation[]
     */
    public function getSelfEvaluations(): Collection
    {
        return $this->selfEvaluations;
    }

    public function addSelfEvaluation(SelfEvaluation $selfEvaluation): self
    {
        if (!$this->selfEvaluations->contains($selfEvaluation)) {
            $this->selfEvaluations[] = $selfEvaluation;
            $selfEvaluation->setCategorie($this);
        }

        return $this;
    }

    public function removeSelfEvaluation(SelfEvaluation $selfEvaluation): self
    {
        if ($this->selfEvaluations->contains($selfEvaluation)) {
            $this->selfEvaluations->removeElement($selfEvaluation);
            // set the owning side to null (unless already changed)
            if ($selfEvaluation->getCategorie() === $this) {
                $selfEvaluation->setCategorie(null);
            }
        }

        return $this;
    }
}
