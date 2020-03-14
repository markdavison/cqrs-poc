<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IpCaseRepository")
 */
class IpCase
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ipNumber;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $territoryCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $caseReference;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Subject", mappedBy="ipCase")
     */
    private $subjects;

    /**
     * IpCase constructor.
     * @param $id
     * @param $ipNumber
     * @param $territoryCode
     * @param $caseReference
     */
    public function __construct(string $ipNumber, string $territoryCode, string $caseReference)
    {
        $this->ipNumber = $ipNumber;
        $this->territoryCode = $territoryCode;
        $this->caseReference = $caseReference;
        $this->subjects = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCaseReference(): ?string
    {
        return $this->caseReference;
    }

    public function setCaseReference(string $caseReference): self
    {
        $this->caseReference = $caseReference;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIpNumber() :?string
    {
        return $this->ipNumber;
    }

    /**
     * @param mixed $ipNumber
     * @return IpCase
     */
    public function setIpNumber(string $ipNumber) :self
    {
        $this->ipNumber = $ipNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerritoryCode() :string
    {
        return $this->territoryCode;
    }

    /**
     * @param mixed $territoryCode
     * @return IpCase
     */
    public function setTerritoryCode(string $territoryCode) :self
    {
        $this->territoryCode = $territoryCode;
        return $this;
    }

    /**
     * @return Collection|Subject[]
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects[] = $subject;
            $subject->setIpCase($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        if ($this->subjects->contains($subject)) {
            $this->subjects->removeElement($subject);
            // set the owning side to null (unless already changed)
            if ($subject->getIpCase() === $this) {
                $subject->setIpCase(null);
            }
        }

        return $this;
    }
}
