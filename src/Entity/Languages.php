<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguagesRepository")
 */
class Languages
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $written;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $spoken;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PersonalInfo", inversedBy="languages")
     */
    private $personalinfo;

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

    public function getWritten(): ?string
    {
        return $this->written;
    }

    public function setWritten(?string $written): self
    {
        $this->written = $written;

        return $this;
    }

    public function getSpoken(): ?string
    {
        return $this->spoken;
    }

    public function setSpoken(?string $spoken): self
    {
        $this->spoken = $spoken;

        return $this;
    }

    public function getPersonalinfo(): ?PersonalInfo
    {
        return $this->personalinfo;
    }

    public function setPersonalinfo(?PersonalInfo $personalinfo): self
    {
        $this->personalinfo = $personalinfo;

        return $this;
    }
}
