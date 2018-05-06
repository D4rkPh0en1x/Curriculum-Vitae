<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobsRepository")
 */
class Jobs
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
    private $location;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $jobstart;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $jobend;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $employedas;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getJobstart(): ?\DateTimeInterface
    {
        return $this->jobstart;
    }

    public function setJobstart(?\DateTimeInterface $jobstart): self
    {
        $this->jobstart = $jobstart;

        return $this;
    }

    public function getJobend(): ?\DateTimeInterface
    {
        return $this->jobend;
    }

    public function setJobend(?\DateTimeInterface $jobend): self
    {
        $this->jobend = $jobend;

        return $this;
    }

    public function getEmployedas(): ?string
    {
        return $this->employedas;
    }

    public function setEmployedas(?string $employedas): self
    {
        $this->employedas = $employedas;

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
}
