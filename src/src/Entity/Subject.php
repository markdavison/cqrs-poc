<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 */
class Subject implements EntityInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $data = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IpCase", inversedBy="subjects")
     */
    private $ipCase;

    /**
     * Subject constructor.
     * @param array $data
     * @param $IpCase
     */
    public function __construct(IpCase $ipCase, array $data)
    {
        $this->data = $data;
        $this->ipCase = $ipCase;
        $ipCase->addSubject($this);
    }


    public function getId(): ?string
    {
        return $this->id;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function setData(?array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setIpCase(?IpCase $ipCase): self
    {
        $this->ipCase = $ipCase;

        return $this;
    }
}
