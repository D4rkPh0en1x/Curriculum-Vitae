<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvalCategoriesRepository")
 */
class EvalCategories
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
     * @ORM\ManyToOne(targetEntity="App\Entity\SelfEvaluation", inversedBy="evalCategories")
     */
    private $selfevaluation;

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

    public function getSelfevaluation(): ?SelfEvaluation
    {
        return $this->selfevaluation;
    }

    public function setSelfevaluation(?SelfEvaluation $selfevaluation): self
    {
        $this->selfevaluation = $selfevaluation;

        return $this;
    }
}
