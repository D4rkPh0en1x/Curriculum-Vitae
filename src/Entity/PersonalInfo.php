<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonalInfoRepository")
 */
class PersonalInfo
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
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $birthplace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $citizenship;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maritalstatus;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $children;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $salary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mobilephone;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $smoker;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $drivinglicence;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Web", mappedBy="personalinfo")
     */
    private $webs;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hobbies", mappedBy="personalinfo")
     */
    private $hobbies;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SoftSkills", mappedBy="personalinfo")
     */
    private $softSkills;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AcquiredSkills", mappedBy="personalinfo")
     */
    private $acquiredSkills;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Languages", mappedBy="personalinfo")
     */
    private $languages;

    public function __construct()
    {
        $this->webs = new ArrayCollection();
        $this->hobbies = new ArrayCollection();
        $this->softSkills = new ArrayCollection();
        $this->acquiredSkills = new ArrayCollection();
        $this->languages = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getBirthplace(): ?string
    {
        return $this->birthplace;
    }

    public function setBirthplace(?string $birthplace): self
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    public function getCitizenship(): ?string
    {
        return $this->citizenship;
    }

    public function setCitizenship(?string $citizenship): self
    {
        $this->citizenship = $citizenship;

        return $this;
    }

    public function getMaritalstatus(): ?string
    {
        return $this->maritalstatus;
    }

    public function setMaritalstatus(?string $maritalstatus): self
    {
        $this->maritalstatus = $maritalstatus;

        return $this;
    }

    public function getChildren(): ?int
    {
        return $this->children;
    }

    public function setChildren(?int $children): self
    {
        $this->children = $children;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getMobilephone(): ?string
    {
        return $this->mobilephone;
    }

    public function setMobilephone(?string $mobilephone): self
    {
        $this->mobilephone = $mobilephone;

        return $this;
    }

    public function getSmoker(): ?bool
    {
        return $this->smoker;
    }

    public function setSmoker(?bool $smoker): self
    {
        $this->smoker = $smoker;

        return $this;
    }

    public function getDrivinglicence(): ?string
    {
        return $this->drivinglicence;
    }

    public function setDrivinglicence(?string $drivinglicence): self
    {
        $this->drivinglicence = $drivinglicence;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|Web[]
     */
    public function getWebs(): Collection
    {
        return $this->webs;
    }

    public function addWeb(Web $web): self
    {
        if (!$this->webs->contains($web)) {
            $this->webs[] = $web;
            $web->setPersonalinfo($this);
        }

        return $this;
    }

    public function removeWeb(Web $web): self
    {
        if ($this->webs->contains($web)) {
            $this->webs->removeElement($web);
            // set the owning side to null (unless already changed)
            if ($web->getPersonalinfo() === $this) {
                $web->setPersonalinfo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hobbies[]
     */
    public function getHobbies(): Collection
    {
        return $this->hobbies;
    }

    public function addHobby(Hobbies $hobby): self
    {
        if (!$this->hobbies->contains($hobby)) {
            $this->hobbies[] = $hobby;
            $hobby->setPersonalinfo($this);
        }

        return $this;
    }

    public function removeHobby(Hobbies $hobby): self
    {
        if ($this->hobbies->contains($hobby)) {
            $this->hobbies->removeElement($hobby);
            // set the owning side to null (unless already changed)
            if ($hobby->getPersonalinfo() === $this) {
                $hobby->setPersonalinfo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SoftSkills[]
     */
    public function getSoftSkills(): Collection
    {
        return $this->softSkills;
    }

    public function addSoftSkill(SoftSkills $softSkill): self
    {
        if (!$this->softSkills->contains($softSkill)) {
            $this->softSkills[] = $softSkill;
            $softSkill->setPersonalinfo($this);
        }

        return $this;
    }

    public function removeSoftSkill(SoftSkills $softSkill): self
    {
        if ($this->softSkills->contains($softSkill)) {
            $this->softSkills->removeElement($softSkill);
            // set the owning side to null (unless already changed)
            if ($softSkill->getPersonalinfo() === $this) {
                $softSkill->setPersonalinfo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AcquiredSkills[]
     */
    public function getAcquiredSkills(): Collection
    {
        return $this->acquiredSkills;
    }

    public function addAcquiredSkill(AcquiredSkills $acquiredSkill): self
    {
        if (!$this->acquiredSkills->contains($acquiredSkill)) {
            $this->acquiredSkills[] = $acquiredSkill;
            $acquiredSkill->setPersonalinfo($this);
        }

        return $this;
    }

    public function removeAcquiredSkill(AcquiredSkills $acquiredSkill): self
    {
        if ($this->acquiredSkills->contains($acquiredSkill)) {
            $this->acquiredSkills->removeElement($acquiredSkill);
            // set the owning side to null (unless already changed)
            if ($acquiredSkill->getPersonalinfo() === $this) {
                $acquiredSkill->setPersonalinfo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Languages[]
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Languages $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages[] = $language;
            $language->setPersonalinfo($this);
        }

        return $this;
    }

    public function removeLanguage(Languages $language): self
    {
        if ($this->languages->contains($language)) {
            $this->languages->removeElement($language);
            // set the owning side to null (unless already changed)
            if ($language->getPersonalinfo() === $this) {
                $language->setPersonalinfo(null);
            }
        }

        return $this;
    }
}
